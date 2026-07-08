<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-emerald-900 dark:text-emerald-400 leading-tight" style="font-family: 'Playfair Display', serif;">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Alert/Card -->
            <div class="relative bg-gradient-to-br from-[#064e3b] via-[#043b2d] to-[#022c22] text-white rounded-3xl shadow-xl p-8 md:p-10 flex flex-col md:flex-row justify-between items-center overflow-hidden border border-emerald-500/20 shadow-emerald-950/10">
                <!-- Decorative pattern background -->
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml;utf8,<svg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><path d=&quot;M30 0 L60 30 L30 60 L0 30 Z&quot; fill=&quot;none&quot; stroke=&quot;%23ffffff&quot; stroke-width=&quot;1&quot;/></svg>'); background-repeat: repeat;"></div>
                
                <!-- Glowing accent circle -->
                <div class="absolute right-0 top-0 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
                
                <!-- Elegant SVG Mosque Dome Line Art on the right side -->
                <div class="absolute right-0 bottom-0 opacity-[0.12] dark:opacity-[0.18] pointer-events-none translate-x-12 translate-y-8 md:translate-x-6 md:translate-y-4">
                    <svg width="220" height="220" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Dome outline -->
                        <path d="M50 5 C35 25 30 35 30 55 C30 75 35 85 50 95 C65 85 70 75 70 55 C70 35 65 25 50 5 Z" stroke="#fbbf24" stroke-width="2" />
                        <path d="M50 10 C38 28 34 37 34 55 C34 71 38 81 50 90 C62 81 66 71 66 55 C66 37 62 28 50 10 Z" stroke="#fbbf24" stroke-width="1" stroke-dasharray="2 2" />
                        <!-- Minaret/Crescent -->
                        <line x1="50" y1="5" x2="50" y2="0" stroke="#fbbf24" stroke-width="1.5"/>
                        <circle cx="50" cy="0" r="1.5" fill="#fbbf24"/>
                        <!-- Horizontal base arches -->
                        <path d="M20 95 L80 95" stroke="#fbbf24" stroke-width="2"/>
                    </svg>
                </div>

                <div class="relative z-10 space-y-3 max-w-xl text-center md:text-left">
                    <span class="inline-block px-3 py-1 bg-amber-400/20 border border-amber-400/30 text-amber-300 text-[10px] font-extrabold uppercase tracking-widest rounded-full">
                        SIMPES AL-AMIN
                    </span>
                    <h3 class="text-3xl font-bold tracking-tight text-white leading-tight" style="font-family: 'Playfair Display', serif;">
                        Selamat Datang kembali, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-emerald-100/90 text-sm font-medium leading-relaxed">
                        Sistem Informasi Pondok Pesantren Al-Amin siap membantu mengelola asrama, data santri, dan administrasi keuangan secara efisien hari ini.
                    </p>
                </div>
                
                <div class="relative z-10 mt-6 md:mt-0 shrink-0 bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl text-sm font-semibold border border-white/15 text-amber-300 shadow-lg">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>
            </div>


            @if(Auth::user()->isAdmin() || Auth::user()->isPengurus())
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Santri -->
                    <div class="group bg-white dark:bg-[#12221b]/40 p-6 rounded-2xl shadow-sm border-t-4 border-t-emerald-600 border-x border-b border-gray-100 dark:border-emerald-500/10 hover:-translate-y-1 hover:shadow-md hover:border-emerald-500/20 transition-all duration-300 flex items-center justify-between overflow-hidden relative">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/5 rounded-full pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <span class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Total Santri</span>
                            <h4 class="text-3xl font-extrabold mt-1.5 text-gray-800 dark:text-white" style="font-family: 'Outfit', sans-serif;">{{ $totalSantri }}</h4>
                            <span class="text-[10px] text-emerald-700 dark:text-emerald-300 font-extrabold bg-emerald-500/10 px-2.5 py-0.5 rounded-full mt-3 inline-block">
                                +{{ max(0, $totalSantri - 2) }} Terdaftar Baru
                            </span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500/10 to-emerald-500/20 dark:from-[#08201a] dark:to-[#08201a] border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:bg-gradient-to-tr group-hover:from-emerald-600 group-hover:to-emerald-500 group-hover:text-white transition-all duration-300 relative z-10 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>

                    <!-- Santri Aktif -->
                    <div class="group bg-white dark:bg-[#12221b]/40 p-6 rounded-2xl shadow-sm border-t-4 border-t-blue-500 border-x border-b border-gray-100 dark:border-emerald-500/10 hover:-translate-y-1 hover:shadow-md hover:border-emerald-500/20 transition-all duration-300 flex items-center justify-between overflow-hidden relative">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-blue-500/5 rounded-full pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <span class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Santri Aktif</span>
                            <h4 class="text-3xl font-extrabold mt-1.5 text-gray-800 dark:text-white" style="font-family: 'Outfit', sans-serif;">{{ $activeSantriCount }}</h4>
                            <span class="text-[10px] text-blue-700 dark:text-blue-300 font-extrabold bg-blue-500/10 px-2.5 py-0.5 rounded-full mt-3 inline-block">
                                Sedang Belajar
                            </span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-500/10 to-blue-500/20 dark:from-[#0f2430] dark:to-[#0f2430] border border-blue-550/20 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:bg-gradient-to-tr group-hover:from-blue-600 group-hover:to-blue-500 group-hover:text-white transition-all duration-300 relative z-10 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                    </div>

                    <!-- SPP Lunas Bulan Ini -->
                    <div class="group bg-white dark:bg-[#12221b]/40 p-6 rounded-2xl shadow-sm border-t-4 border-t-amber-500 border-x border-b border-gray-100 dark:border-emerald-500/10 hover:-translate-y-1 hover:shadow-md hover:border-emerald-500/20 transition-all duration-300 flex items-center justify-between overflow-hidden relative">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-500/5 rounded-full pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <span class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Pemasukan Bulan Ini</span>
                            <h4 class="text-2xl font-extrabold mt-1.5 text-gray-800 dark:text-white" style="font-family: 'Outfit', sans-serif;">Rp {{ number_format($totalPemasukanBulanIni, 0, ',', '.') }}</h4>
                            <span class="text-[10px] text-amber-700 dark:text-amber-300 font-extrabold bg-amber-500/10 px-2.5 py-0.5 rounded-full mt-3 inline-block">
                                Syahriah Masuk
                            </span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-500/10 to-amber-500/20 dark:from-[#312510] dark:to-[#312510] border border-amber-550/20 text-amber-600 dark:text-amber-400 flex items-center justify-center group-hover:bg-gradient-to-tr group-hover:from-amber-600 group-hover:to-amber-500 group-hover:text-white transition-all duration-300 relative z-10 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>

                    <!-- Total Tunggakan -->
                    <div class="group bg-white dark:bg-[#12221b]/40 p-6 rounded-2xl shadow-sm border-t-4 border-t-red-500 border-x border-b border-gray-100 dark:border-emerald-500/10 hover:-translate-y-1 hover:shadow-md hover:border-emerald-500/20 transition-all duration-300 flex items-center justify-between overflow-hidden relative">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-red-500/5 rounded-full pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <span class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Total Tunggakan</span>
                            <h4 class="text-2xl font-extrabold mt-1.5 text-red-650 dark:text-red-400" style="font-family: 'Outfit', sans-serif;">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</h4>
                            <span class="text-[10px] text-red-700 dark:text-red-300 font-extrabold bg-red-500/10 px-2.5 py-0.5 rounded-full mt-3 inline-block">
                                Belum Lunas
                            </span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-red-500/10 to-red-500/20 dark:from-[#311012] dark:to-[#311012] border border-red-550/20 text-red-600 dark:text-red-400 flex items-center justify-center group-hover:bg-gradient-to-tr group-hover:from-red-600 group-hover:to-red-500 group-hover:text-white transition-all duration-300 relative z-10 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Main Dashboard Content Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Columns: Graph & Recent Logs (Span 2) -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Line Chart Card -->
                        <div class="bg-white dark:bg-[#12221b]/30 rounded-2xl shadow-md shadow-emerald-950/5 border border-emerald-500/10 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500/5 via-emerald-500/10 to-transparent dark:from-emerald-950/40 dark:to-transparent border-b border-emerald-500/10 px-6 py-4 flex justify-between items-center">
                                <div>
                                    <h4 class="text-base font-extrabold text-emerald-900 dark:text-emerald-350" style="font-family: 'Playfair Display', serif;">Statistik Pendaftaran Santri Baru</h4>
                                    <p class="text-[11px] text-gray-500 dark:text-gray-405 mt-0.5">Grafik pendaftaran santri baru per bulan di tahun {{ now()->year }}</p>
                                </div>
                                <span class="text-[10px] bg-emerald-600/10 text-emerald-700 dark:text-emerald-400 px-3 py-1 rounded-full font-bold border border-emerald-500/10">Tahun {{ now()->year }}</span>
                            </div>
                            <div class="p-6">
                                <div class="relative h-72 w-full">
                                    <canvas id="registrationChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Logs Activities Card -->
                        <div class="bg-white dark:bg-[#12221b]/30 rounded-2xl shadow-md shadow-emerald-950/5 border border-emerald-500/10 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500/5 via-emerald-500/10 to-transparent dark:from-emerald-950/40 dark:to-transparent border-b border-emerald-500/10 px-6 py-4">
                                <h4 class="text-base font-extrabold text-emerald-900 dark:text-emerald-350" style="font-family: 'Playfair Display', serif;">Aktivitas & Transaksi Terkini</h4>
                                <p class="text-[11px] text-gray-500 dark:text-gray-405 mt-0.5">Data ter-update langsung dari sistem pondok pesantren</p>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <!-- Pendaftaran Terbaru -->
                                    <div>
                                        <div class="flex items-center gap-2 mb-4">
                                            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span>
                                            <h5 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Santri Baru Terdaftar</h5>
                                        </div>
                                        <div class="space-y-4">
                                            @forelse($recentRegistrations as $santri)
                                                <div class="flex items-center gap-3 py-1.5 border-b border-gray-50 dark:border-gray-800/40 last:border-0">
                                                    <div class="w-10 h-10 rounded-full bg-emerald-50 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-400 font-bold flex items-center justify-center text-sm shrink-0 border border-emerald-500/10">
                                                        {{ strtoupper(substr($santri->nama_lengkap, 0, 2)) }}
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $santri->nama_lengkap }}</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">NIS: {{ $santri->nis }} | {{ $santri->kelas->nama_kelas ?? 'Belum Ada Kelas' }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <span class="text-[10px] bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 px-2 py-0.5 rounded-full font-bold whitespace-nowrap">
                                                            {{ $santri->tanggal_masuk->translatedFormat('d M') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-sm text-gray-450 text-center py-6">Belum ada santri baru terdaftar.</p>
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Pembayaran Terbaru -->
                                    @php
                                        $bulanIndo = [
                                            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                                            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                                        ];
                                    @endphp
                                    <div>
                                        <div class="flex items-center gap-2 mb-4">
                                            <span class="w-2.5 h-2.5 bg-amber-500 rounded-full"></span>
                                            <h5 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Pembayaran SPP Terakhir</h5>
                                        </div>
                                        <div class="space-y-4">
                                            @forelse($recentPayments as $pembayaran)
                                                <div class="flex items-center gap-3 py-1.5 border-b border-gray-50 dark:border-gray-800/40 last:border-0">
                                                    <div class="w-10 h-10 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 border border-amber-500/20">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $pembayaran->santri->nama_lengkap ?? 'Santri' }}</p>
                                                        <p class="text-xs text-gray-550 dark:text-gray-405 truncate">SPP {{ $bulanIndo[$pembayaran->bulan] ?? $pembayaran->bulan }} {{ $pembayaran->tahun }}</p>
                                                    </div>
                                                    <div class="text-right shrink-0">
                                                        <p class="text-sm font-bold text-emerald-600 dark:text-emerald-450">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
                                                        <p class="text-[9px] text-gray-400">{{ $pembayaran->tanggal_bayar->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-sm text-gray-450 text-center py-6">Belum ada transaksi pembayaran.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Timeline Schedule & Quick Actions (Span 1) -->
                    <div class="space-y-8">
                        
                        <!-- Quick Actions Card -->
                        <div class="bg-white dark:bg-[#12221b]/30 rounded-2xl shadow-md shadow-emerald-950/5 border border-emerald-500/10 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500/5 via-emerald-500/10 to-transparent dark:from-emerald-950/40 dark:to-transparent border-b border-emerald-500/10 px-6 py-4">
                                <h4 class="text-base font-extrabold text-emerald-900 dark:text-emerald-350" style="font-family: 'Playfair Display', serif;">Aksi Cepat</h4>
                                <p class="text-[11px] text-gray-500 dark:text-gray-405 mt-0.5">Menu navigasi operasional utama</p>
                            </div>
                            <div class="p-6 space-y-3">
                                <a href="{{ route('santri.create') }}" class="group flex items-start gap-3.5 p-3.5 rounded-xl bg-gray-50/50 dark:bg-emerald-950/20 hover:bg-emerald-500/10 dark:hover:bg-emerald-900/30 transition-all duration-300 border border-gray-100 dark:border-emerald-500/5 hover:border-emerald-500/20">
                                    <span class="p-2.5 bg-emerald-100 dark:bg-emerald-900/60 rounded-xl text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                    </span>
                                    <div>
                                        <p class="font-bold text-sm text-gray-800 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">Santri Baru</p>
                                        <p class="text-xs text-gray-550 dark:text-gray-400 mt-0.5">Input berkas dan profil santri baru.</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('pembayaran.index') }}" class="group flex items-start gap-3.5 p-3.5 rounded-xl bg-gray-50/50 dark:bg-emerald-950/20 hover:bg-amber-500/10 dark:hover:bg-amber-900/20 transition-all duration-300 border border-gray-100 dark:border-emerald-500/5 hover:border-amber-500/20">
                                    <span class="p-2.5 bg-amber-100 dark:bg-amber-950/60 rounded-xl text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                    </span>
                                    <div>
                                        <p class="font-bold text-sm text-gray-800 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">Kelola SPP / Syahriah</p>
                                        <p class="text-xs text-gray-550 dark:text-gray-400 mt-0.5">Monitoring pembayaran berkala santri.</p>
                                    </div>
                                </a>

                                <a href="{{ route('kelas.index') }}" class="group flex items-start gap-3.5 p-3.5 rounded-xl bg-gray-50/50 dark:bg-emerald-950/20 hover:bg-blue-500/10 dark:hover:bg-blue-900/20 transition-all duration-300 border border-gray-100 dark:border-emerald-500/5 hover:border-blue-500/20">
                                    <span class="p-2.5 bg-blue-100 dark:bg-blue-900/60 rounded-xl text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </span>
                                    <div>
                                        <p class="font-bold text-sm text-gray-800 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">Distribusi Kelas</p>
                                        <p class="text-xs text-gray-550 dark:text-gray-400 mt-0.5">Atur penempatan marhalah & wali kelas.</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Jadwal Kegiatan Harian Pondok -->
                        <div class="bg-white dark:bg-[#12221b]/30 rounded-2xl shadow-md shadow-emerald-950/5 border border-emerald-500/10 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-500/5 via-amber-500/10 to-transparent dark:from-amber-950/30 dark:to-transparent border-b border-amber-500/15 px-6 py-4">
                                <h4 class="text-base font-extrabold text-amber-850 dark:text-amber-400" style="font-family: 'Playfair Display', serif;">Jadwal Harian Pondok</h4>
                                <p class="text-[11px] text-gray-500 dark:text-gray-405 mt-0.5">Rutinitas kegiatan wajib santri Al-Amin</p>
                            </div>
                            <div class="p-6">
                                <div class="relative pl-6 border-l-2 border-emerald-100 dark:border-emerald-950 space-y-5">
                                    <!-- Step 1 -->
                                    <div class="relative">
                                        <span class="absolute -left-[31px] top-1 bg-amber-400 border-4 border-white dark:border-[#0a1411] w-4.5 h-4.5 rounded-full shadow-sm"></span>
                                        <p class="text-xs font-extrabold text-amber-500">04:00 - 05:30</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-0.5">Subuh & Dzikir Jama'ah</p>
                                        <p class="text-[11px] text-gray-405">Masjid Jami' Pondok Pesantren</p>
                                    </div>
                                    <!-- Step 2 -->
                                    <div class="relative">
                                        <span class="absolute -left-[31px] top-1 bg-emerald-500 border-4 border-white dark:border-[#0a1411] w-4.5 h-4.5 rounded-full shadow-sm"></span>
                                        <p class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400">07:30 - 12:00</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-0.5">Madrasah Diniyah (Madin)</p>
                                        <p class="text-[11px] text-gray-405">Pembelajaran Kitab fiqih & tauhid</p>
                                    </div>
                                    <!-- Step 3 -->
                                    <div class="relative">
                                        <span class="absolute -left-[31px] top-1 bg-emerald-500 border-4 border-white dark:border-[#0a1411] w-4.5 h-4.5 rounded-full shadow-sm"></span>
                                        <p class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400">14:00 - 15:30</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-0.5">Ekstrakurikuler & Bahasa</p>
                                        <p class="text-[11px] text-gray-405">Muhadlarah pidato & percakapan</p>
                                    </div>
                                    <!-- Step 4 -->
                                    <div class="relative">
                                        <span class="absolute -left-[31px] top-1 bg-amber-400 border-4 border-white dark:border-[#0a1411] w-4.5 h-4.5 rounded-full shadow-sm"></span>
                                        <p class="text-xs font-extrabold text-amber-500">18:30 - 19:45</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-0.5">Halaqah Tahfidz Quran</p>
                                        <p class="text-[11px] text-gray-450">Setoran hafalan rutin ba'da Maghrib</p>
                                    </div>
                                    <!-- Step 5 -->
                                    <div class="relative">
                                        <span class="absolute -left-[31px] top-1 bg-emerald-500 border-4 border-white dark:border-[#0a1411] w-4.5 h-4.5 rounded-full shadow-sm"></span>
                                        <p class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400">20:00 - 21:30</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-0.5">Kajian Kitab Kuning</p>
                                        <p class="text-[11px] text-gray-455">Kajian hadits & fiqih bersama Kyai</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @else
                <!-- Santri/Wali Dashboard View (NEW Elegant Design) -->
                <div class="relative bg-white dark:bg-[#12221b]/40 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-emerald-500/10 dark:border-emerald-500/20 overflow-hidden text-center max-w-3xl mx-auto space-y-6">
                    <!-- Background ornaments -->
                    <div class="absolute -top-12 -left-12 w-32 h-32 bg-emerald-500/5 rounded-full blur-xl pointer-events-none"></div>
                    <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-amber-500/5 rounded-full blur-xl pointer-events-none"></div>
                    <div class="absolute inset-0 opacity-[0.02] pointer-events-none" style="background-image: url('data:image/svg+xml;utf8,<svg width=&quot;40&quot; height=&quot;40&quot; viewBox=&quot;0 0 40 40&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><path d=&quot;M20 0 L40 20 L20 40 L0 20 Z&quot; fill=&quot;none&quot; stroke=&quot;%23ffffff&quot; stroke-width=&quot;1&quot;/></svg>');"></div>

                    <!-- Glowing Icon Shield -->
                    <div class="relative w-24 h-24 bg-gradient-to-tr from-emerald-500/20 to-teal-500/20 dark:from-emerald-500/10 dark:to-teal-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center mx-auto border border-emerald-500/20 shadow-md">
                        <x-application-logo class="w-16 h-16" />
                    </div>

                    <!-- Text description block -->
                    <div class="max-w-lg mx-auto space-y-3">
                        <span class="inline-block px-3 py-1 bg-amber-500/10 border border-amber-500/20 text-amber-500 dark:text-amber-400 text-xs font-extrabold uppercase tracking-widest rounded-full">Portal Wali Santri & Santri</span>
                        <h4 class="text-2xl font-bold text-gray-800 dark:text-white" style="font-family: 'Playfair Display', serif;">Akses Profil & Pembayaran Keuangan</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed font-medium">Selamat datang di SIMPES Al-Amin. Anda masuk sebagai Wali Santri / Santri. Anda dapat memantau profil akademis, data kamar penempatan asrama, serta riwayat lengkap pembayaran SPP bulanan.</p>
                    </div>

                    <div class="h-px bg-gray-100 dark:bg-emerald-950 max-w-sm mx-auto"></div>

                    <!-- CTA Actions -->
                    <div>
                        <a href="{{ route('my.profile') }}" class="group inline-flex items-center gap-2 px-8 py-3.5 border border-transparent text-sm font-bold rounded-2xl text-white bg-emerald-600 hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/35 hover:-translate-y-0.5 duration-200">
                            <span>Buka Halaman Profil Saya</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            @endif


        </div>
    </div>

    @if(Auth::user()->isAdmin() || Auth::user()->isPengurus())
        <!-- Chart.js Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('registrationChart').getContext('2d');
                
                // Ambil data PHP chartData (1 s/d 12)
                const phpData = @json(array_values($chartData));
                
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        indigo: '#10b981',
                        datasets: [{
                            label: 'Santri Terdaftar',
                            data: phpData,
                            borderColor: '#10b981', // Emerald 500
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#10b981',
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    color: '#9ca3af'
                                },
                                grid: {
                                    color: 'rgba(156, 163, 175, 0.1)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#9ca3af'
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
</x-app-layout>
