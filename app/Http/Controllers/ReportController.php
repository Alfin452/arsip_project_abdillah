<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\Disposition;
use App\Models\Category;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Halaman Menu Utama (Pilihan Laporan).
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * 1. PREVIEW Laporan Surat Masuk
     */
    public function incoming(Request $request)
    {
        // Default tanggal: Awal bulan ini s/d Hari ini
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $data = IncomingLetter::with('category')
            ->whereBetween('letter_date', [$startDate, $endDate])
            ->orderBy('letter_date', 'asc')
            ->get();

        return view('reports.incoming', compact('data', 'startDate', 'endDate'));
    }

    /**
     * 2. PREVIEW Laporan Surat Keluar
     */
    public function outgoing(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $data = OutgoingLetter::with('category')
            ->whereBetween('letter_date', [$startDate, $endDate])
            ->orderBy('letter_date', 'asc')
            ->get();

        return view('reports.outgoing', compact('data', 'startDate', 'endDate'));
    }

    /**
     * 3. PREVIEW Laporan Disposisi
     */
    public function disposition(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));
        $status = $request->input('status', 'all');

        $query = Disposition::with(['incomingLetter', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($status != 'all') {
            $query->where('status', $status);
        }

        $data = $query->latest()->get();

        return view('reports.disposition', compact('data', 'startDate', 'endDate', 'status'));
    }

    // ... Method PRINT (printIncoming, printOutgoing, dll) BIARKAN TETAP ADA ...
    // ... Jangan dihapus method print-nya, karena tombol cetak nanti mengarah ke situ ...

    // Contoh method printIncoming (Pastikan masih ada):
    public function printIncoming(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $data = IncomingLetter::with('category')->whereBetween('letter_date', [$startDate, $endDate])->orderBy('letter_date', 'asc')->get();
        return view('reports.print-incoming', compact('data', 'startDate', 'endDate'));
    }

    // ... dst untuk printOutgoing, printDisposition ...

    // Method printCategory tidak perlu preview karena cuma tabel kecil, langsung print saja atau buat preview jika mau.
    public function printCategory()
    {
        $data = Category::withCount(['incomingLetters', 'outgoingLetters'])->get();
        return view('reports.print-category', compact('data'));
    }

    public function printSheet($id)
    {
        $letter = IncomingLetter::with(['category', 'dispositions.user'])->findOrFail($id);
        return view('reports.print-sheet', compact('letter'));
    }

    // --- LAPORAN 5: KINERJA PEGAWAI (Preview) ---
    public function staff(Request $request)
    {
        // Ambil semua user kecuali Admin (Role Admin biasanya tidak menerima disposisi)
        // Hitung jumlah disposisi berdasarkan statusnya
        $data = \App\Models\User::where('role', 'karyawan')
            ->withCount([
                'dispositions as total_assigned',
                'dispositions as total_pending' => function ($q) {
                    $q->where('status', 'pending');
                },
                'dispositions as total_process' => function ($q) {
                    $q->where('status', 'processed');
                },
                'dispositions as total_completed' => function ($q) {
                    $q->where('status', 'completed');
                }
            ])
            ->get();

        return view('reports.staff', compact('data'));
    }

    // --- LAPORAN 5: KINERJA PEGAWAI (Cetak) ---
    public function printStaff()
    {
        $data = \App\Models\User::where('role', 'karyawan')
            ->withCount([
                'dispositions as total_assigned',
                'dispositions as total_pending' => function ($q) {
                    $q->where('status', 'pending');
                },
                'dispositions as total_process' => function ($q) {
                    $q->where('status', 'processed');
                },
                'dispositions as total_completed' => function ($q) {
                    $q->where('status', 'completed');
                }
            ])
            ->get();

        return view('reports.print-staff', compact('data'));
    }

    /**
     * CETAK Laporan Disposisi
     */
    public function printDisposition(Request $request)
    {
        // Ambil parameter tanggal dan status dari request
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));
        $status = $request->input('status', 'all');

        // Query data sama seperti preview
        $query = Disposition::with(['incomingLetter', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Filter status jika tidak 'all'
        if ($status != 'all') {
            $query->where('status', $status);
        }

        $data = $query->latest()->get();

        // Return ke view cetak (pastikan file view reports/print-disposition.blade.php ada)
        return view('reports.print-disposition', compact('data', 'startDate', 'endDate', 'status'));
    }
}
