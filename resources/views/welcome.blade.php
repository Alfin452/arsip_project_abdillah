<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Arsip') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-slate-50 text-slate-600">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 text-white p-2 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-slate-800 tracking-tight">E-Arsip Digital</span>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
                        Masuk Aplikasi
                    </a>
                    @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <span class="inline-block py-1 px-3 rounded-full bg-indigo-50 text-indigo-600 text-xs font-bold uppercase tracking-wider mb-6 border border-indigo-100">
                Sistem Informasi Manajemen Arsip
            </span>

            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight">
                Kelola Arsip Instansi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Lebih Cepat & Aman.</span>
            </h1>

            <p class="mt-4 text-xl text-slate-500 max-w-2xl mx-auto mb-10">
                Tinggalkan cara lama. Digitalisasikan surat masuk, surat keluar, dan disposisi dalam satu platform terintegrasi.
            </p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="px-8 py-4 text-base font-bold text-white bg-slate-900 rounded-2xl hover:bg-slate-800 transition shadow-xl hover:-translate-y-1">
                    Mulai Sekarang
                </a>
                <a href="#features" class="px-8 py-4 text-base font-bold text-slate-600 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 transition hover:-translate-y-1">
                    Pelajari Fitur
                </a>
            </div>

            <div class="mt-16 relative mx-auto max-w-5xl">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl p-2 shadow-2xl shadow-indigo-200">
                    <img src="{{ asset('images/dashboard-preview.png') }}"
                        alt="Preview Dashboard E-Arsip"
                        class="w-full h-auto rounded-2xl shadow-sm border border-slate-100 bg-white"
                        onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'bg-slate-50 h-64 flex items-center justify-center rounded-2xl text-slate-400 font-bold\'>Silakan simpan screenshot dashboard di public/images/dashboard-preview.png</div>'">
                </div>
            </div>
        </div>

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>
    </section>

    <section id="features" class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-800">Kenapa E-Arsip?</h2>
                <p class="text-slate-500 mt-2">Fitur lengkap untuk kebutuhan administrasi modern.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition group">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm text-indigo-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Arsip Digital</h3>
                    <p class="text-slate-500 leading-relaxed">Simpan surat masuk dan keluar dalam format digital (PDF/Gambar). Mudah dicari kapan saja tanpa membongkar lemari.</p>
                </div>

                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition group">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm text-indigo-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Disposisi Cepat</h3>
                    <p class="text-slate-500 leading-relaxed">Pimpinan dapat memberikan instruksi disposisi langsung melalui sistem. Notifikasi real-time untuk efisiensi kinerja.</p>
                </div>

                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition group">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm text-indigo-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Laporan Otomatis</h3>
                    <p class="text-slate-500 leading-relaxed">Cetak buku agenda, monitoring kinerja, dan statistik surat dalam sekali klik. Format laporan rapi dan standar.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-10 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} E-Arsip Digital. Dikembangkan untuk keperluan Instansi.
            </p>
        </div>
    </footer>

    <style>
        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>
</body>

</html>