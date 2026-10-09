<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SMM Digital') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-[#0f5132] to-[#00a651]">
        <div>
            <a href="/" class="flex flex-col items-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center border-4 border-[#fbbf24] shadow-lg">
                    <span class="text-[#0f5132] text-2xl font-bold">SMM</span>
                </div>
                <p class="text-white font-semibold text-lg mt-3">SMM Digital</p>
                <p class="text-green-100 text-xs"></p>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-lg overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>