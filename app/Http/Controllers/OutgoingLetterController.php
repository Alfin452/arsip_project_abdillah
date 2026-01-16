<?php

namespace App\Http\Controllers;

use App\Models\OutgoingLetter;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutgoingLetterController extends Controller
{
    /**
     * Menampilkan daftar surat keluar (Support AJAX Search).
     */
    public function index(Request $request)
    {
        $query = OutgoingLetter::with('category');

        // 1. Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reference_number', 'like', "%{$search}%")
                    ->orWhere('destination', 'like', "%{$search}%") // Bedanya disini: Destination
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 2. Filter Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 3. Sorting
        if ($request->order == 'oldest') {
            $query->oldest('letter_date');
        } else {
            $query->latest('letter_date');
        }

        $letters = $query->paginate(10)->withQueryString();

        // AJAX Response untuk Live Search
        if ($request->ajax()) {
            return view('outgoing-letters.partials.rows', compact('letters'))->render();
        }

        $categories = Category::all();
        return view('outgoing-letters.index', compact('letters', 'categories'));
    }

    /**
     * Form tambah surat.
     */
    public function create()
    {
        $categories = Category::all();
        return view('outgoing-letters.create', compact('categories'));
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference_number' => 'required|string|max:255|unique:outgoing_letters',
            'destination'      => 'required|string|max:255',
            'letter_date'      => 'required|date',
            'category_id'      => 'required|exists:categories,id',
            'description'      => 'required|string',
            'file'             => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat-keluar', 'public');
        }

        OutgoingLetter::create([
            'reference_number' => $request->reference_number,
            'destination'      => $request->destination,
            'letter_date'      => $request->letter_date,
            'category_id'      => $request->category_id,
            'description'      => $request->description,
            'file_path'        => $filePath,
        ]);

        return redirect()->route('outgoing-letters.index')
            ->with('success', 'Surat keluar berhasil diarsipkan.');
    }

    /**
     * Detail surat.
     */
    public function show(OutgoingLetter $outgoingLetter)
    {
        $outgoingLetter->load('category');
        return view('outgoing-letters.show', compact('outgoingLetter'));
    }

    /**
     * Form edit.
     */
    public function edit(OutgoingLetter $outgoingLetter)
    {
        $categories = Category::all();
        return view('outgoing-letters.edit', compact('outgoingLetter', 'categories'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, OutgoingLetter $outgoingLetter)
    {
        $request->validate([
            'reference_number' => 'required|string|max:255|unique:outgoing_letters,reference_number,' . $outgoingLetter->id,
            'destination'      => 'required|string|max:255',
            'letter_date'      => 'required|date',
            'category_id'      => 'required|exists:categories,id',
            'description'      => 'required|string',
            'file'             => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->only(['reference_number', 'destination', 'letter_date', 'category_id', 'description']);

        if ($request->hasFile('file')) {
            if ($outgoingLetter->file_path && Storage::disk('public')->exists($outgoingLetter->file_path)) {
                Storage::disk('public')->delete($outgoingLetter->file_path);
            }
            $data['file_path'] = $request->file('file')->store('surat-keluar', 'public');
        }

        $outgoingLetter->update($data);

        return redirect()->route('outgoing-letters.show', $outgoingLetter->id)
            ->with('success', 'Data surat keluar berhasil diperbarui.');
    }

    /**
     * Hapus data.
     */
    public function destroy(OutgoingLetter $outgoingLetter)
    {
        if ($outgoingLetter->file_path && Storage::disk('public')->exists($outgoingLetter->file_path)) {
            Storage::disk('public')->delete($outgoingLetter->file_path);
        }

        $outgoingLetter->delete();

        return redirect()->route('outgoing-letters.index')
            ->with('success', 'Arsip surat keluar berhasil dihapus.');
    }
}
