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
    <body class="font-sans text-gray-900 antialiased" style="font-family: 'Outfit', sans-serif;">
        <div class="min-h-screen flex flex-col lg:flex-row bg-[#FAF8F5] dark:bg-[#0b120f]">
            
            <!-- Left Side: Immersive Branding Panel -->
            <div class="relative w-full lg:w-1/2 min-h-[40vh] lg:min-h-screen bg-gradient-to-br from-[#064e3b] via-[#022c22] to-[#011a14] flex flex-col justify-between p-8 lg:p-16 overflow-hidden">
                <!-- Background Islamic Geometric Pattern -->
                <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] pointer-events-none" style="background-image: url('data:image/svg+xml;utf8,<svg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><path d=&quot;M30 0 L60 30 L30 60 L0 30 Z&quot; fill=&quot;none&quot; stroke=&quot;%23ffffff&quot; stroke-width=&quot;1&quot;/><circle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;10&quot; fill=&quot;none&quot; stroke=&quot;%23ffffff&quot; stroke-width=&quot;1&quot;/></svg>'); background-repeat: repeat;"></div>
                
                <!-- Floating glows -->
                <div class="absolute -top-32 -left-32 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-32 -right-32 w-[30rem] h-[30rem] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Top Brand Info -->
                <div class="relative z-10 flex items-center gap-3">
                    <x-application-logo class="w-12 h-12" />
                    <div>
                        <h1 class="font-extrabold text-xl tracking-wide text-white leading-none">SIPONTREN</h1>
                        <p class="text-[10px] text-amber-400 font-bold tracking-wider uppercase mt-1">Al-Amin Boarding School</p>
                    </div>
                </div>

                <!-- Center Content (Pesantren Slogan/Quote) -->
                <div class="relative z-10 my-auto py-8 space-y-4 max-w-md">
                    <span class="inline-block px-3 py-1 bg-amber-500/15 border border-amber-500/30 text-amber-300 text-xs font-bold tracking-widest uppercase rounded-full">
                        Sistem Manajemen Pondok
                    </span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-white tracking-tight leading-tight" style="font-family: 'Playfair Display', serif;">
                        Pusat Pembinaan Akhlak Mulia & Ilmu Pengetahuan
                    </h2>
                    <div class="h-1 w-20 bg-amber-400 rounded-full"></div>
                    <p class="text-emerald-100/80 leading-relaxed font-medium">
                        Selamat datang di Portal Informasi Santri. Silakan masuk untuk mengakses data profil akademis, asrama, dan administrasi keuangan santri.
                    </p>
                </div>

                <!-- Bottom Quote / Verses -->
                <div class="relative z-10 mt-auto pt-6 border-t border-emerald-800/40 flex items-start gap-3">
                    <span class="text-3xl text-amber-400 leading-none">“</span>
                    <p class="text-sm italic text-emerald-200/90 leading-relaxed font-medium">
                        "Barang siapa yang menempuh suatu jalan untuk mencari ilmu, maka Allah akan memudahkan baginya jalan menuju surga." (HR. Muslim)
                    </p>
                </div>
            </div>

            <!-- Right Side: Login / Register Form Panel -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-16 relative">
                <!-- Decorative light glows -->
                <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

                <div class="w-full max-w-md relative z-10">
                    <div class="mb-8 text-center lg:text-left">
                        <!-- Mobile logo only -->
                        <div class="lg:hidden flex justify-center mb-6">
                            <x-application-logo class="w-20 h-20" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Selamat Datang</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 font-medium">Masukkan akun terdaftar Anda untuk memulai sesi.</p>
                    </div>

                    <div class="bg-white dark:bg-[#111c17] p-8 rounded-2xl shadow-xl shadow-emerald-950/5 border border-emerald-500/5 dark:border-emerald-500/10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>

