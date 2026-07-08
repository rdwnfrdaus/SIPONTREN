<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Kamar / Asrama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950 border-l-4 border-emerald-500 text-emerald-800 dark:text-emerald-200 rounded-r-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Tabel Daftar Kamar -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Kamar / Asrama</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase">
                                    <th class="p-4">Nama Kamar</th>
                                    <th class="p-4">Gedung / Blok</th>
                                    <th class="p-4">Kapasitas</th>
                                    <th class="p-4">Keterisian</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                                @forelse($kamars as $km)
                                    <tr class="hover:bg-gray-50/55 dark:hover:bg-gray-900/40 transition">
                                        <td class="p-4 font-semibold text-gray-900 dark:text-white">{{ $km->nama_kamar }}</td>
                                        <td class="p-4">{{ $km->gedung }}</td>
                                        <td class="p-4 font-mono">{{ $km->kapasitas }} Orang</td>
                                        <td class="p-4">
                                            <div class="flex items-center gap-2">
                                                <!-- progress bar -->
                                                <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                    @php
                                                        $percentage = min(100, ($km->santris_count / max(1, $km->kapasitas)) * 100);
                                                        $barColor = $percentage >= 100 ? 'bg-red-500' : ($percentage >= 80 ? 'bg-amber-500' : 'bg-emerald-500');
                                                    @endphp
                                                    <div class="{{ $barColor }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                                </div>
                                                <span class="font-bold text-xs">{{ $km->santris_count }} / {{ $km->kapasitas }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('kamar.edit', $km) }}" class="p-2 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950 rounded-lg transition" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                </a>
                                                <form action="{{ route('kamar.destroy', $km) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini? Semua santri di kamar ini akan diset tanpa penempatan kamar.')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950 rounded-lg transition" title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                            Belum ada kamar terdaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Form Tambah Kamar -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 h-fit space-y-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-2">Tambah Kamar Baru</h3>
                    
                    <form action="{{ route('kamar.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nama Kamar</label>
                            <input type="text" name="nama_kamar" placeholder="Contoh: Kamar Abu Bakar" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Gedung / Blok</label>
                            <input type="text" name="gedung" placeholder="Contoh: Asrama Putra Blok A" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Kapasitas Maksimal (Orang)</label>
                            <input type="number" name="kapasitas" min="1" value="10" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                        </div>

                        <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition">
                            Tambah Kamar
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
