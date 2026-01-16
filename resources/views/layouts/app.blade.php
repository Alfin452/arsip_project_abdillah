<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        @include('layouts.sidebar')

        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">

            <header class="bg-white shadow">
                <div class="px-6 py-4">
                    @if (isset($header))
                    {{ $header }}
                    @else
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Arsip Surat
                    </h2>
                    @endif
                </div>
            </header>

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>

</html>