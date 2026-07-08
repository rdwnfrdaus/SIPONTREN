<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Keuangan - Pembayaran SPP / Syahriah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-950 border-l-4 border-emerald-500 text-emerald-800 dark:text-emerald-200 rounded-r-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-red-50 dark:bg-red-950 border-l-4 border-red-500 text-red-800 dark:text-red-200 rounded-r-xl text-sm space-y-1">
                    <p class="font-bold">Terjadi Kesalahan:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Panel Generate Tagihan Bulanan (Col 1) -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 h-fit space-y-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-2">Generate Tagihan Bulanan</h3>
                    <p class="text-xs text-gray-400">Buat tagihan SPP bulanan baru secara otomatis untuk seluruh santri yang berstatus **Aktif**.</p>
                    
                    <form action="{{ route('pembayaran.generate') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
                                <select name="bulan" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                                    @for($m=1; $m<=12; $m++)
                                        <option value="{{ $m }}" {{ old('bulan', date('n')) == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                                <select name="tahun" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                                    @for($y=date('Y')-1; $y<=date('Y')+3; $y++)
                                        <option value="{{ $y }}" {{ old('tahun', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nominal Tagihan (Rp)</label>
                            <input type="number" name="jumlah_tagihan" min="0" value="250000" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                        </div>

                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin men-generate tagihan bulan ini?')" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm transition">
                            Generate Tagihan Massal
                        </button>
                    </form>
                </div>

                <!-- Tabel Filter & List Tagihan (Col 2 & 3) -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden space-y-4">
                    <!-- Form Filter Pencarian -->
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <form action="{{ route('pembayaran.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <div class="md:col-span-2">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari santri..." class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm">
                            </div>
                            <div>
                                <select name="status" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm">
                                    <option value="">Semua Status</option>
                                    <option value="belum_lunas" {{ request('status') === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="lunas" {{ request('status') === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 py-2 bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 text-white rounded-xl text-sm font-medium">Cari</button>
                                <a href="{{ route('pembayaran.index') }}" class="py-2 px-3 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 text-gray-700 dark:text-gray-200 rounded-xl text-sm font-medium">Clear</a>
                            </div>
                        </form>
                    </div>

                    <!-- List Data -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase">
                                    <th class="p-4">Santri</th>
                                    <th class="p-4">Bulan / Tahun</th>
                                    <th class="p-4">Tagihan</th>
                                    <th class="p-4">Dibayar</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                                @forelse($pembayarans as $pembayaran)
                                    <!-- Alpine.js wrapper for payment toggle -->
                                    <tr x-data="{ openPay: false }" class="hover:bg-gray-50/55 dark:hover:bg-gray-900/40 transition">
                                        <td class="p-4">
                                            <p class="font-bold text-gray-900 dark:text-white">{{ $pembayaran->santri->nama_lengkap }}</p>
                                            <span class="text-xs text-gray-400 font-mono">{{ $pembayaran->santri->nis }}</span>
                                        </td>
                                        <td class="p-4 font-medium">{{ \Carbon\Carbon::create()->month($pembayaran->bulan)->translatedFormat('F') }} {{ $pembayaran->tahun }}</td>
                                        <td class="p-4 font-mono">Rp {{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}</td>
                                        <td class="p-4 font-mono">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                        <td class="p-4">
                                            @if($pembayaran->status === 'lunas')
                                                <span class="px-2 py-0.5 bg-emerald-50 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 rounded text-xs font-bold uppercase">Lunas</span>
                                            @else
                                                <span class="px-2 py-0.5 bg-red-50 dark:bg-red-950 text-red-600 dark:text-red-400 rounded text-xs font-bold uppercase">Belum Lunas</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <div class="flex justify-center gap-2">
                                                @if($pembayaran->status !== 'lunas')
                                                    <button @click="openPay = !openPay" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-semibold transition">
                                                        Bayar
                                                    </button>
                                                @endif
                                                <form action="{{ route('pembayaran.destroy', $pembayaran) }}" method="POST" onsubmit="return confirm('Hapus tagihan ini?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950 rounded-lg transition" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Alpine.js Inline Payment Form Row -->
                                    <tr x-show="openPay" x-transition class="bg-gray-50 dark:bg-gray-900">
                                        <td colspan="6" class="p-6">
                                            <form action="{{ route('pembayaran.bayar', $pembayaran) }}" method="POST" class="space-y-4">
                                                @csrf
                                                <div class="flex flex-col md:flex-row gap-4 items-end">
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-500 mb-1">Jumlah Pembayaran (Rp)</label>
                                                        @php
                                                            $sisaTagihan = $pembayaran->jumlah_tagihan - $pembayaran->jumlah_bayar;
                                                        @endphp
                                                        <input type="number" name="jumlah_bayar" max="{{ $sisaTagihan }}" min="1" value="{{ $sisaTagihan }}" required class="rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm w-48">
                                                    </div>
                                                    <div class="flex-1">
                                                        <label class="block text-xs font-bold text-gray-500 mb-1">Keterangan / Catatan Pembayaran</label>
                                                        <input type="text" name="keterangan" placeholder="Contoh: Tunai via Ustadz Ahmad, Transfer Bank Mandiri" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white text-sm">
                                                    </div>
                                                    <div class="flex gap-2">
                                                        <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition">
                                                            Konfirmasi Bayar
                                                        </button>
                                                        <button type="button" @click="openPay = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-medium rounded-xl text-sm transition">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                            Tagihan tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($pembayarans->hasPages())
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600">
                            {{ $pembayarans->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
