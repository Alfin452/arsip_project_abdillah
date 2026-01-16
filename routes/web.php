<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomingLetterController;
use App\Http\Controllers\OutgoingLetterController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\UserController; // <--- Import ini
use App\Http\Controllers\CategoryController; // <--- Import
use App\Http\Controllers\DashboardController; // <--- Import
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group untuk SEMUA User yang sudah login (Admin & Karyawan)
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard & Profile bisa diakses semua
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- FITUR UMUM (Bisa diakses Admin & Karyawan) ---
    // Disposisi (Karyawan butuh update status, Admin butuh monitoring)
    Route::resource('dispositions', DispositionController::class);

    // Surat Masuk & Keluar (Biasanya Karyawan TU juga boleh input)
    // Kalo instansi kamu melarang Karyawan biasa input surat, pindahkan ke group Admin di bawah.
    Route::resource('incoming-letters', IncomingLetterController::class);
    Route::resource('outgoing-letters', OutgoingLetterController::class);

    // --- KHUSUS ADMIN (Gunakan Middleware 'role:admin') ---
    Route::middleware(['role:admin'])->group(function () {

        // Manajemen User (Staff TIDAK BOLEH masuk sini)
        Route::resource('users', UserController::class);

        // Master Kategori
        Route::resource('categories', CategoryController::class);

        // Laporan (Biasanya hanya admin/pimpinan yang cetak)
        // Kalau staff boleh cetak, pindahkan keluar group ini.
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/incoming', [ReportController::class, 'incoming'])->name('reports.incoming');
        Route::get('/reports/outgoing', [ReportController::class, 'outgoing'])->name('reports.outgoing');
        Route::get('/reports/disposition', [ReportController::class, 'disposition'])->name('reports.disposition');

        // Print Routes
        Route::get('/reports/print/incoming', [ReportController::class, 'printIncoming'])->name('reports.print.incoming');
        Route::get('/reports/print/outgoing', [ReportController::class, 'printOutgoing'])->name('reports.print.outgoing');
        Route::get('/reports/print/category', [ReportController::class, 'printCategory'])->name('reports.print.category');
        Route::get('/reports/print/disposition', [ReportController::class, 'printDisposition'])->name('reports.print.disposition');
    });

    // Cetak Lembar Disposisi & Download File (Boleh semua staff terkait)
    Route::get('/reports/print/sheet/{id}', [ReportController::class, 'printSheet'])->name('reports.print.sheet');
});

require __DIR__.'/auth.php';
