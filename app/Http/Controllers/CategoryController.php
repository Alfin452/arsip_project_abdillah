<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('code', 'like', '%' . $request->search . '%');
        }

        $categories = $query->orderBy('code', 'asc')->paginate(10);

        // --- TAMBAHAN AJAX RESPONSE ---
        if ($request->ajax()) {
            return view('categories.partials.rows', compact('categories'))->render();
        }
        // ------------------------------

        return view('categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:categories,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Form edit kategori.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update kategori.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:categories,code,' . $category->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Data kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori.
     */
    public function destroy(Category $category)
    {
        // Cek apakah kategori ini dipakai di surat masuk/keluar?
        // Kalau dipakai, sebaiknya jangan dihapus sembarangan.
        if ($category->incomingLetters()->count() > 0 || $category->outgoingLetters()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Kategori ini sedang digunakan oleh arsip surat.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
