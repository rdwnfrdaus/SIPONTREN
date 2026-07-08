<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-800 dark:text-gray-200" style="font-family: 'Outfit', sans-serif;">
        <div class="min-h-screen bg-gradient-to-br from-[#e6f0eb] via-[#f4f8f6] to-[#dceded] dark:from-[#07110c] dark:via-[#0c1612] dark:to-[#091b15] relative overflow-hidden transition-colors duration-300">
            <!-- Decorative Serene Glows -->
            <div class="absolute top-0 right-0 w-[32rem] h-[32rem] bg-emerald-500/10 dark:bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[36rem] h-[36rem] bg-amber-500/10 dark:bg-emerald-950/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-[#dbe7e0] dark:bg-[#071611]/60 border-b border-emerald-500/10 relative overflow-hidden">
                        <!-- Decorative glow inside page header -->
                        <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 relative z-10">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="relative z-10">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>

