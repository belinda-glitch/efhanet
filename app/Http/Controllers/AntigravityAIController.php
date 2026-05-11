<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Gemini;
use Illuminate\Support\Str;

class AntigravityAIController extends Controller
{
    /**
     * AI-Powered Project Forecasting
     * Menganalisis kesehatan finansial dan estimasi ketepatan waktu proyek.
     */
    public function index($id)
    {
        // 1. Ambil data proyek dengan total pengeluaran (expenses)
        $project = Project::withSum('expenses', 'jumlah_nominal')->findOrFail($id);

        // 2. Persiapkan variabel untuk AI
        $namaProyek = $project->nama;
        $budget = number_format($project->budget_awal, 0, ',', '.');
        $terpakai = number_format($project->expenses_sum_jumlah_nominal ?? 0, 0, ',', '.');
        $progres = $project->technical_progress . '%';
        $deadline = $project->deadline ? $project->deadline->format('d M Y') : 'Belum ditentukan';
        $sisaBudget = number_format($project->budget_awal - ($project->expenses_sum_jumlah_nominal ?? 0), 0, ',', '.');

        $tanggalMulai = $project->created_at ? $project->created_at->format('d M Y') : 'Belum ditentukan';

        // 3. Inisialisasi Gemini Client
        $apiKey = trim(env('GEMINI_API_KEY'));
        
        if (empty($apiKey) || $apiKey === 'isi_dengan_api_key_gemini_anda') {
            return back()->with('error', 'Konfigurasi AI tidak ditemukan. Mohon atur GEMINI_API_KEY di file .env');
        }

        // 4. Susun Prompt Strategis (Pakar Infrastruktur)
        $prompt = "
            Identitas: Kamu adalah 'Antigravity AI', pakar manajemen proyek infrastruktur telekomunikasi di PT Efha Sejahtera Bersama (Pontianak).
            
            Konteks Proyek:
            - Proyek: {$namaProyek}
            - Tanggal Mulai: {$tanggalMulai}
            - Target Deadline: {$deadline}
            - Progres Lapangan: {$progres}
            - Anggaran: Rp {$budget}
            - Realisasi Biaya: Rp {$terpakai} (Sisa: Rp {$sisaBudget})

            Tugas:
            Berikan analisis kritis yang profesional (Gunakan format Markdown):
            1. Analisis Kecepatan: Apakah progres {$progres} masuk akal mengingat waktu yang sudah berjalan sejak {$tanggalMulai} hingga sisa waktu menuju {$deadline}? (Jika waktu sudah berjalan 50% tapi progres baru 10%, berikan status DELAY).
            2. Prediksi Akhir: Berikan estimasi berapa hari proyek akan terlambat jika kecepatan kerja (burn rate progres) tetap sama seperti saat ini.
            3. Analisis Efisiensi: Apakah pengeluaran Rp {$terpakai} sebanding dengan pencapaian progres tersebut?
            4. Mitigasi: 1 langkah taktis untuk mengejar ketertinggalan dan mengamankan margin profit.
        ";

        try {
            $client = Gemini::client($apiKey);
            
            // 5. Menggunakan model gemini-2.5-flash
            $result = $client->generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $analysis = $result->text();

            if (empty($analysis)) {
                throw new \Exception("AI tidak memberikan respon (Empty Response).");
            }

            return view('admin.forecast', [
                'project' => $project,
                'analysis' => $analysis
            ]);

        } catch (\Exception $e) {
            // Log error untuk debug internal
            \Log::error("Gemini AI Error: " . $e->getMessage());
            
            // Berikan pesan yang lebih bersahabat ke user
            $errorMsg = $e->getMessage();
            if (str_contains($errorMsg, 'API key not valid')) {
                $errorMsg = "API Key Gemini tidak valid. Mohon periksa kembali file .env Anda.";
            }
            
            return back()->with('error', 'Antigravity AI: ' . $errorMsg);
        }
    }
}
