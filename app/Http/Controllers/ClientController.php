<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Menampilkan daftar proyek milik klien yang sedang login.
     */
    public function index()
    {
        $query = Project::query();

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $projects = $query->latest()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Menampilkan detail proyek khusus untuk klien.
     * Hanya mengirimkan data akumulasi finansial guna menjaga kerahasiaan internal.
     */
    public function show($id)
    {
        $project = Project::with(['expenses', 'documentations'])->findOrFail($id);

        // Jika user adalah Admin, arahkan ke view Admin Detail
        if (Auth::user()->role === 'admin') {
            return view('admin.project_detail', compact('project'));
        }

        // Cek kepemilikan proyek jika bukan admin
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        // Menghitung akumulasi finansial strategis
        $total_anggaran = $project->budget_awal;
        $anggaran_terpakai = $project->expenses->sum('jumlah_nominal');
        $sisa_anggaran = $total_anggaran - $anggaran_terpakai;

        return view('projects.show', compact(
            'project',
            'total_anggaran',
            'anggaran_terpakai',
            'sisa_anggaran'
        ));
    }

    /**
     * Fitur Antigravity Concierge untuk memberikan insight ramah kepada klien.
     */
    public function insight($id)
    {
        // Keamanan: Pastikan proyek milik klien yang sedang login
        $project = Project::where('user_id', Auth::id())
            ->withSum('expenses', 'jumlah_nominal')
            ->findOrFail($id);

        $namaProyek = $project->nama;
        $budget = number_format($project->budget_awal, 0, ',', '.');
        $terpakai = number_format($project->expenses_sum_jumlah_nominal ?? 0, 0, ',', '.');
        $progres = $project->technical_progress . '%';
        $deadline = $project->deadline ? $project->deadline->format('d M Y') : 'Belum ditentukan';

        $apiKey = trim(env('GEMINI_API_KEY'));
        
        if (empty($apiKey) || $apiKey === 'isi_dengan_api_key_gemini_anda') {
            return back()->with('error', 'Konfigurasi AI tidak ditemukan. Mohon hubungi admin.');
        }

        $prompt = "
            Identitas: Kamu adalah 'Antigravity Concierge', asisten virtual profesional dan sangat ramah dari PT Efha Sejahtera Bersama (Pontianak).
            
            Konteks Proyek Klien:
            - Proyek: {$namaProyek}
            - Anggaran Proyek: Rp {$budget}
            - Dana yang telah direalisasikan untuk pekerjaan lapangan: Rp {$terpakai}
            - Pencapaian Progres Teknis: {$progres}
            - Estimasi Selesai: {$deadline}

            Tugas:
            Berikan laporan status proyek yang menenangkan, transparan, dan profesional kepada klien. 
            PENTING: 
            1. JANGAN BAHAS soal 'profit', 'keuntungan', atau 'kerugian' perusahaan karena ini laporan untuk klien eksternal.
            2. Fokuslah pada memberikan apresiasi, menjelaskan bahwa dana digunakan dengan baik (transparan), dan yakinkan bahwa tim sedang berusaha mencapai target {$progres} menuju 100%.
            3. Gunakan bahasa Indonesia yang sopan, hangat, dan profesional. Gunakan format Markdown yang rapi.
        ";

        try {
            $client = \Gemini::client($apiKey);
            
            // PENTING: Gunakan model gemini-2.5-flash secara eksplisit
            $result = $client->generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $insight = $result->text();

            if (empty($insight)) {
                throw new \Exception("AI tidak memberikan respon (Empty Response).");
            }

            return view('client.project.insight', [
                'project' => $project,
                'insight' => $insight
            ]);

        } catch (\Exception $e) {
            \Log::error("Gemini AI Concierge Error: " . $e->getMessage());
            $errorMsg = $e->getMessage();
            if (str_contains($errorMsg, 'API key not valid')) {
                $errorMsg = "Layanan Concierge sedang dalam pemeliharaan (Invalid Key).";
            }
            return back()->with('error', 'Antigravity Concierge: ' . $errorMsg);
        }
    }
}
