<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use Illuminate\Http\Request;
use App\Models\Category; // <--- Jangan lupa ini
use Illuminate\Support\Facades\Storage; // <--- Untuk storage
use App\Models\User; // <--- Jangan lupa import ini di paling atas

class IncomingLetterController extends Controller
{
    /**
     * Menampilkan daftar surat masuk.
     */
    public function index(Request $request)
    {
        // ... (Query logic pencarian/filter SAMA SEPERTI SEBELUMNYA) ...
        $query = IncomingLetter::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reference_number', 'like', "%{$search}%")
                    ->orWhere('origin', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->order == 'oldest') {
            $query->oldest('letter_date');
        } else {
            $query->latest('letter_date');
        }

        $letters = $query->paginate(10)->withQueryString();

        // --- TAMBAHAN KHUSUS AJAX ---
        if ($request->ajax()) {
            return view('incoming-letters.partials.rows', compact('letters'))->render();
        }
        // ----------------------------

        $categories = Category::all();
        return view('incoming-letters.index', compact('letters', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('incoming-letters.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'reference_number' => 'required|string|max:255',
            'origin'           => 'required|string|max:255',
            'agenda_number'    => 'required|string|max:100', // Biasanya manual
            'letter_date'      => 'required|date',
            'received_date'    => 'required|date',
            'category_id'      => 'required|exists:categories,id',
            'description'      => 'required|string',
            'file'             => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // Max 10MB
        ]);

        // 2. Proses Upload File
        // File akan disimpan di folder: storage/app/public/surat-masuk
        $filePath = $request->file('file')->store('surat-masuk', 'public');

        // 3. Simpan ke Database
        IncomingLetter::create([
            'reference_number' => $request->reference_number,
            'origin'           => $request->origin,
            'agenda_number'    => $request->agenda_number,
            'letter_date'      => $request->letter_date,
            'received_date'    => $request->received_date,
            'description'      => $request->description,
            'category_id'      => $request->category_id,
            'file_path'        => $filePath,
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('incoming-letters.index')
            ->with('success', 'Surat masuk berhasil diarsipkan.');
    }

    /**
     * Menampilkan detail surat beserta file lampirannya.
     */
    public function show(IncomingLetter $incomingLetter)
    {
        // Load kategori dan relasi dispositions (beserta user-nya)
        $incomingLetter->load(['category', 'dispositions.user']);

        // Ambil daftar user yang role-nya karyawan untuk dropdown tujuan
        $users = User::where('role', 'karyawan')->get();

        return view('incoming-letters.show', compact('incomingLetter', 'users'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(IncomingLetter $incomingLetter)
    {
        $categories = Category::all();
        return view('incoming-letters.edit', compact('incomingLetter', 'categories'));
    }

    /**
     * Memproses update data ke database.
     */
    public function update(Request $request, IncomingLetter $incomingLetter)
    {
        // 1. Validasi (File dibuat nullable/opsional)
        $request->validate([
            'reference_number' => 'required|string|max:255',
            'origin'           => 'required|string|max:255',
            'agenda_number'    => 'required|string|max:100',
            'letter_date'      => 'required|date',
            'received_date'    => 'required|date',
            'category_id'      => 'required|exists:categories,id',
            'description'      => 'required|string',
            'file'             => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // Boleh kosong
        ]);

        // 2. Siapkan data yang mau diupdate
        $data = [
            'reference_number' => $request->reference_number,
            'origin'           => $request->origin,
            'agenda_number'    => $request->agenda_number,
            'letter_date'      => $request->letter_date,
            'received_date'    => $request->received_date,
            'description'      => $request->description,
            'category_id'      => $request->category_id,
        ];

        // 3. Cek apakah user upload file baru?
        if ($request->hasFile('file')) {
            // Hapus file lama dari storage jika ada
            if ($incomingLetter->file_path && Storage::disk('public')->exists($incomingLetter->file_path)) {
                Storage::disk('public')->delete($incomingLetter->file_path);
            }

            // Upload file baru
            $filePath = $request->file('file')->store('surat-masuk', 'public');
            $data['file_path'] = $filePath;
        }

        // 4. Update Database
        $incomingLetter->update($data);

        return redirect()->route('incoming-letters.show', $incomingLetter->id)
            ->with('success', 'Data surat berhasil diperbarui.');
    }

    /**
     * Menghapus data surat dan file fisiknya.
     */
    public function destroy(IncomingLetter $incomingLetter)
    {
        // 1. Hapus File Fisik (PDF/Gambar) dari Storage
        if ($incomingLetter->file_path && Storage::disk('public')->exists($incomingLetter->file_path)) {
            Storage::disk('public')->delete($incomingLetter->file_path);
        }

        // 2. Hapus Data dari Database
        // (Data Disposisi akan otomatis terhapus jika di migration kamu set onDelete('cascade'))
        $incomingLetter->delete();

        // 3. Kembali ke index dengan pesan sukses
        return redirect()->route('incoming-letters.index')
            ->with('success', 'Arsip surat berhasil dihapus permanen.');
    }

    public function export()
    {
        // Ambil semua data surat masuk
        $letters = IncomingLetter::with('category')->orderBy('letter_date', 'desc')->get();

        // Nama file saat didownload
        $filename = "surat_masuk_" . date('Y-m-d_H-i') . ".xls";

        // Header agar browser membacanya sebagai file Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        // Tampilkan view khusus tabel (tanpa layout website)
        return view('incoming-letters.export-excel', compact('letters'));
    }
}
