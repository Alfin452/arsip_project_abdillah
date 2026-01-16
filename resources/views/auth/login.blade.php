<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white">

    <div class="min-h-screen flex">

        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div class="mb-10">
                    <a href="/" class="flex items-center gap-2 mb-8 group">
                        <div class="bg-indigo-600 text-white p-2 rounded-xl group-hover:bg-indigo-700 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-slate-800">E-Arsip Digital</span>
                    </a>

                    <h2 class="text-3xl font-extrabold text-slate-900">Selamat Datang</h2>
                    <p class="mt-2 text-sm text-slate-500">Silakan login untuk mengakses sistem.</p>
                </div>

                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700">Email</label>
                        <div class="mt-2 relative">
                            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-4 py-3 border border-slate-300 rounded-xl placeholder-slate-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition" value="{{ old('email') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                        </div>
                        @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                        <div class="mt-2 relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-4 py-3 border border-slate-300 rounded-xl placeholder-slate-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 focus:bg-white transition">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-slate-600">
                                Ingat Saya
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Lupa Password?
                            </a>
                        </div>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-500/30 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition hover:-translate-y-0.5">
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="mt-10">
                    <p class="text-center text-xs text-slate-400">
                        &copy; {{ date('Y') }} E-Arsip Digital System.
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden lg:block relative w-0 flex-1">
            <div class="absolute inset-0 h-full w-full bg-slate-900">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-purple-700 opacity-90"></div>
                <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); background-size: cover; mix-blend-mode: overlay;"></div>

                <div class="absolute inset-0 flex flex-col justify-end p-20 text-white z-10">
                    <div class="mb-6 p-4 bg-white/10 backdrop-blur-sm rounded-2xl w-fit border border-white/20">
                        <svg class="w-8 h-8 text-indigo-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9.01699V21H14.017ZM16.017 21V16H19.017C20.1216 16 21.017 16.8954 21.017 18V21H16.017ZM7.01699 16H2.01699V21H7.01699V16ZM7.01699 14H2.01699V7C2.01699 4.23858 4.25557 2 7.01699 2H10.017V14H7.01699ZM12.017 14H19.017C20.1216 14 21.017 14.8954 21.017 16V14H12.017ZM12.017 12V2H17.017C19.7784 2 22.017 4.23858 22.017 7V12H12.017Z"></path>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-extrabold mb-4 leading-tight">Manajemen Arsip <br>yang Efisien & Terstruktur.</h2>
                    <p class="text-indigo-100 text-lg max-w-lg">Sistem informasi untuk pengelolaan surat masuk, surat keluar, dan disposisi secara digital.</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>