<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profil Lengkap Santri') }}
            </h2>
            @if(Auth::user()->isAdmin() || Auth::user()->isPengurus())
                <div class="flex gap-2">
                    <a href="{{ route('santri.edit', $santri) }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-xl text-sm transition">
                        Edit Profil
                    </a>
                    <a href="{{ route('santri.index') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl text-sm transition">
                        Kembali
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Grid Atas: Info Profil Utama -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card Foto & Info Pokok -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 text-center flex flex-col justify-center items-center">
                    <div class="w-24 h-24 bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center text-4xl font-extrabold uppercase">
                        {{ substr($santri->nama_lengkap, 0, 2) }}
                    </div>
                    <h3 class="text-xl font-bold mt-4 text-gray-800 dark:text-white">{{ $santri->nama_lengkap }}</h3>
                    <p class="text-sm font-mono text-gray-500 dark:text-gray-400 mt-1">NIS: {{ $santri->nis }}</p>
                    
                    <div class="mt-4">
                        @if($santri->status === 'aktif')
                            <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-bold uppercase">Aktif</span>
                        @elseif($santri->status === 'lulus')
                            <span class="px-3 py-1 bg-blue-50 dark:bg-blue-950 text-blue-700 dark:text-blue-300 rounded-full text-xs font-bold uppercase">Lulus</span>
                        @else
                            <span class="px-3 py-1 bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-300 rounded-full text-xs font-bold uppercase">Pindah</span>
                        @endif
                    </div>

                    <div class="w-full grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 text-left">
                        <div>
                            <span class="text-xs text-gray-400">Kelas</span>
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $santri->kelas->nama_kelas ?? 'Belum Ada' }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">Kamar</span>
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $santri->kamar->nama_kamar ?? 'Belum Ada' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card Detail Biodata -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 md:col-span-2 space-y-4">
                    <h4 class="text-lg font-bold text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-2">Detail Biodata</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-400 block">Jenis Kelamin</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $santri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Tempat, Tanggal Lahir</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir->translatedFormat('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Orang Tua / Wali</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $santri->nama_ortu_wali }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">No. HP Wali</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $santri->no_hp_wali }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Tanggal Masuk Pesantren</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $santri->tanggal_masuk->translatedFormat('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Akun Portal Terhubung</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $santri->user->email ?? 'Belum Dibuat' }}</span>
                        </div>
                    </div>
                    <div class="pt-2">
                        <span class="text-gray-400 block text-sm">Alamat Lengkap</span>
                        <p class="font-medium text-gray-800 dark:text-gray-200 text-sm mt-1 bg-gray-50 dark:bg-gray-900 p-3 rounded-xl border border-gray-100 dark:border-gray-700">{{ $santri->alamat }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Riwayat Pembayaran SPP -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h4 class="text-lg font-bold text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">Riwayat Pembayaran SPP / Syahriah</h4>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase">
                                <th class="p-3">Bulan / Tahun</th>
                                <th class="p-3">Nominal Tagihan</th>
                                <th class="p-3">Nominal Dibayar</th>
                                <th class="p-3">Tanggal Bayar</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                            @forelse($santri->pembayarans as $pembayaran)
                                <tr>
                                    <td class="p-3 font-semibold">{{ \Carbon\Carbon::create()->month($pembayaran->bulan)->translatedFormat('F') }} {{ $pembayaran->tahun }}</td>
                                    <td class="p-3 font-mono">Rp {{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}</td>
                                    <td class="p-3 font-mono">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td class="p-3 text-xs">{{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->translatedFormat('d M Y, H:i') : '-' }}</td>
                                    <td class="p-3">
                                        @if($pembayaran->status === 'lunas')
                                            <span class="px-2 py-0.5 bg-emerald-50 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 rounded text-xs font-bold uppercase">Lunas</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-red-50 dark:bg-red-950 text-red-600 dark:text-red-400 rounded text-xs font-bold uppercase">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td class="p-3 text-xs text-gray-500 dark:text-gray-400">{{ $pembayaran->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-gray-500 dark:text-gray-400">
                                        Belum ada riwayat tagihan SPP untuk santri ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
