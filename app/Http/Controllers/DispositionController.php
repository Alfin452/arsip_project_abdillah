<?php

namespace App\Http\Controllers;

use App\Models\Disposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DispositionController extends Controller
{
    /**
     * Menampilkan daftar disposisi.
     * - Admin: Lihat semua.
     * - Karyawan: Lihat milik sendiri.
     */
    public function index(Request $request)
    {
        $query = Disposition::with(['incomingLetter', 'user']);

        // 1. Filter Role (Karyawan cuma bisa lihat tugasnya sendiri)
        if (Auth::user()->role == 'karyawan') {
            $query->where('user_id', Auth::id());
        }

        // 2. Filter Status (Pending/Process/Completed)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Urutkan berdasarkan Deadline (Yang mau habis waktunya di atas)
        $dispositions = $query->orderBy('due_date', 'asc')->paginate(10)->withQueryString();

        return view('dispositions.index', compact('dispositions'));
    }

    /**
     * Menyimpan disposisi baru (dari halaman Detail Surat Masuk).
     */
    public function store(Request $request)
    {
        $request->validate([
            'incoming_letter_id' => 'required|exists:incoming_letters,id',
            'user_id'            => 'required|exists:users,id',
            'due_date'           => 'required|date',
            'note'               => 'required|string',
        ]);

        Disposition::create([
            'incoming_letter_id' => $request->incoming_letter_id,
            'user_id'            => $request->user_id,
            'due_date'           => $request->due_date,
            'note'               => $request->note,
            'status'             => 'pending',
        ]);

        return redirect()->back()->with('success', 'Disposisi berhasil dikirim.');
    }

    /**
     * Update Status Disposisi (Untuk Staff update progress).
     */
    public function update(Request $request, Disposition $disposition)
    {
        // Pastikan staff cuma bisa update punya sendiri
        if (Auth::user()->role == 'karyawan' && $disposition->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,processed,completed',
        ]);

        $disposition->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status disposisi diperbarui.');
    }

    // Hapus Disposisi (Opsional, biasanya Admin yang butuh)
    public function destroy(Disposition $disposition)
    {
        $disposition->delete();
        return redirect()->back()->with('success', 'Data disposisi dihapus.');
    }
}
