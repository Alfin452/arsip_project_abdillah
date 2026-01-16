<div class="flex flex-col w-72 h-screen bg-slate-900 text-slate-300 border-r border-slate-800 transition-all duration-300">

    <div class="flex items-center gap-3 px-6 h-20 border-b border-slate-800 bg-slate-950/30">
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/20 text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        </div>
        <div class="flex flex-col">
            <span class="text-lg font-bold text-white tracking-wide">E-Arsip</span>
            <span class="text-[10px] font-medium text-slate-500 uppercase tracking-wider">Digital System</span>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">

        @php
        $activeClass = 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30';
        $inactiveClass = 'hover:bg-slate-800 hover:text-white text-slate-400';
        @endphp

        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span class="font-medium text-sm">Dashboard</span>
        </a>

        <div class="pt-6 pb-2 px-4 text-xs font-bold text-slate-600 uppercase tracking-widest">
            Manajemen Surat
        </div>

        <a href="{{ route('incoming-letters.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('incoming.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('incoming.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
            </svg>
            <div class="flex-1 flex justify-between items-center">
                <span class="font-medium text-sm">Surat Masuk</span>
            </div>
        </a>

        <a href="{{ route('outgoing-letters.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('outgoing.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('outgoing.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            <span class="font-medium text-sm">Surat Keluar</span>
        </a>

        <a href="{{ route('dispositions.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('dispositions.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('dispositions.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span class="font-medium text-sm">Disposisi</span>
        </a>

        @if(Auth::user()->role == 'admin')
        <div class="pt-6 pb-2 px-4 text-xs font-bold text-slate-600 uppercase tracking-widest">
            Administrator
        </div>

        <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('users.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('users.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="font-medium text-sm">Data Karyawan</span>
        </a>

        <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('categories.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('categories.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span class="font-medium text-sm">Kategori Surat</span>
        </a>

        <a href="{{ route('reports.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('reports.*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('reports.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="font-medium text-sm">Pusat Laporan</span>
        </a>
        @endif
    </div>

    <div class="p-4 border-t border-slate-800 bg-slate-950/30">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500 uppercase tracking-wide">{{ Auth::user()->role }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center justify-center w-full py-2.5 text-xs font-semibold text-white bg-red-600/10 hover:bg-red-600 border border-red-600/20 hover:border-red-600 rounded-lg transition-all duration-200 group">
                <svg class="w-4 h-4 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Sign Out
            </button>
        </form>
    </div>
</div>