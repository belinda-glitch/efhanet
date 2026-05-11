<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Expense;
use App\Models\ProjectDocumentation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProjectController extends Controller
{
    /**
     * Menampilkan daftar proyek dengan fitur filter wilayah Pontianak.
     */
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('wilayah') && $request->wilayah === 'pontianak') {
            $query->where('kecamatan_pontianak', 'LIKE', '%Pontianak%');
        }

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $projects = $query->with('expenses')->latest()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Form Membuat Proyek Baru (Khusus Admin)
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        
        $clients = User::where('role', 'client')->get();
        return view('admin.projects_create', compact('clients'));
    }

    /**
     * Menyimpan Proyek Baru
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'kecamatan_pontianak' => 'required|string',
            'budget_awal' => 'required|numeric|min:0',
            'service_type' => 'required|string',
            'deadline' => 'nullable|date',
        ]);

        $projectData = $validated;
        $projectData['status_k3'] = 'Menunggu Survey'; // Default status K3 awal

        $project = Project::create($projectData);

        return redirect()->route('admin.dashboard')->with('success', 'Proyek berhasil dibuat.');
    }

    /**
     * Menampilkan detail proyek.
     */
    public function show($id)
    {
        $project = Project::with(['expenses', 'client', 'documentations'])->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $project->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        if (Auth::user()->role === 'admin') {
            return view('admin.project_detail', compact('project'));
        }

        return view('projects.show', compact('project'));
    }

    /**
     * Mencatat Pengeluaran Harian (Khusus Admin)
     */
    public function storeExpense(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'kategori_biaya' => 'required|string',
            'detail_material' => 'nullable|string|max:255',
            'jumlah_nominal' => 'required|numeric|min:0',
            'nota' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $project = Project::findOrFail($id);

        $expenseData = [
            'project_id' => $project->id,
            'kategori_biaya' => $validated['kategori_biaya'],
            'detail_material' => $validated['detail_material'],
            'jumlah_nominal' => $validated['jumlah_nominal'],
        ];

        if ($request->hasFile('nota')) {
            $path = $request->file('nota')->store('notas', 'public');
            $expenseData['nota'] = $path;
        }

        Expense::create($expenseData);

        // Logika Otomatis: Update status K3 jika kategori adalah APD/K3
        if (in_array($validated['kategori_biaya'], ['Alat Pelindung Diri (K3)', 'APD', 'Alat K3'])) {
            $project->update(['status_k3' => 'Kepatuhan K3 Terpenuhi']);
        }

        return back()->with('success', 'Pengeluaran harian berhasil dicatat.');
    }

    /**
     * Update Nota Susulan (Late Receipt Upload)
     */
    public function updateNota(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'nota' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $expense = Expense::findOrFail($id);

        // Hapus file lama jika ada untuk menghemat storage
        if ($expense->nota && Storage::disk('public')->exists($expense->nota)) {
            Storage::disk('public')->delete($expense->nota);
        }
        
        $path = $request->file('nota')->store('notas', 'public');
        $expense->update(['nota' => $path]);

        return back()->with('success', 'Nota berhasil diperbarui.');
    }

    /**
     * Update Status Teknis & Safety
     */
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'work_status' => 'required|string',
            'technical_progress' => 'required|integer|min:0|max:100',
            'daily_toolbox_status' => 'nullable|string',
            'status_k3' => 'required|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        return back()->with('success', 'Status pengerjaan berhasil diperbarui.');
    }

    /**
     * Menyimpan Dokumentasi Proyek (Multi-Upload)
     */
    public function storeDocumentation(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'photos.*' => 'required|image|mimes:jpg,jpeg,png|max:10240', // Max 10MB per photo
            'captions.*' => 'nullable|string|max:500',
        ]);

        $project = Project::findOrFail($id);
        $manager = ImageManager::gd();

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                // Generate Unique Filename
                $filename = time() . '_' . str_replace(' ', '_', $photo->getClientOriginalName());
                
                // Process Main Image (Max 1200px width, 80% quality)
                $image = $manager->read($photo);
                if ($image->width() > 1200) {
                    $image->scale(width: 1200);
                }
                $mainPath = 'documentation/' . $filename;
                Storage::disk('public')->put($mainPath, (string) $image->toJpeg(80));

                // Process Thumbnail (300px cover, 70% quality)
                $thumb = $manager->read($photo);
                $thumb->cover(300, 300);
                $thumbPath = 'documentation/thumbnails/' . $filename;
                Storage::disk('public')->put($thumbPath, (string) $thumb->toJpeg(70));

                // Save to Database
                ProjectDocumentation::create([
                    'project_id' => $project->id,
                    'file_path' => 'public/' . $mainPath,
                    'thumbnail_path' => 'public/' . $thumbPath,
                    'caption' => $request->captions[$index] ?? null,
                ]);
            }
        }

        return back()->with('success', 'Dokumentasi berhasil diunggah.');
    }

    /**
     * Menghapus Dokumentasi Proyek
     */
    public function destroyDocumentation($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $doc = ProjectDocumentation::findOrFail($id);

        // Hapus file fisik (Utama & Thumbnail)
        if (Storage::exists($doc->file_path)) {
            Storage::delete($doc->file_path);
        }
        if ($doc->thumbnail_path && Storage::exists($doc->thumbnail_path)) {
            Storage::delete($doc->thumbnail_path);
        }

        $doc->delete();

        return back()->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
