<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center pt-6 bg-gray-100">
            <div class="mb-6">
                <a href="/">
                    <img src="{{ asset('images/logonnmusicapp.png') }}" alt="Logo" class="w-20 h-20 rounded-full">
                </a>
            </div>

            <div class="w-full max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
                @isset($slot)
                    {{ $slot }}
                @else
                    <p>Nội dung mặc định (nếu không có slot).</p>
                @endisset
            </div>
        </div>
    </body>
</html>