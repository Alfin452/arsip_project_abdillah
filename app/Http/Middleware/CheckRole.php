<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil role user saat ini
        $userRole = Auth::user()->role;

        // 3. Cek apakah role user ada di dalam daftar role yang diizinkan
        // Contoh pemanggilan: middleware('role:admin,karyawan')
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Jika tidak punya akses, lempar error 403 (Forbidden) atau redirect dashboard
        // return abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.'); 

        // Atau biar lebih halus, redirect ke dashboard dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Anda tidak memiliki izin.');
    }
}
