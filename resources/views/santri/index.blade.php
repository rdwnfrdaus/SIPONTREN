<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Data Santri') }}
            </h2>
            <a href="{{ route('santri.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl text-sm transition shadow-md shadow-emerald-500/20">
                + Tambah Santri Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950 border-l-4 border-emerald-500 text-emerald-800 dark:text-emerald-200 rounded-r-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Card -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
                <form action="{{ route('santri.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau NIS..." class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>
                    <div class="w-full md:w-48">
                        <select name="status" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="lulus" {{ request('status') === 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="pindah" {{ request('status') === 'pindah' ? 'selected' : '' }}>Pindah</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-5 py-2 bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 text-white font-medium rounded-xl text-sm transition">
                            Cari
                        </button>
                        <a href="{{ route('santri.index') }}" class="px-5 py-2 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 text-gray-700 dark:text-gray-200 font-medium rounded-xl text-sm transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase">
                                <th class="p-4">NIS</th>
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4">Kelas</th>
                                <th class="p-4">Kamar/Asrama</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">
                            @forelse($santris as $santri)
                                <tr class="hover:bg-gray-50/55 dark:hover:bg-gray-900/40 transition">
                                    <td class="p-4 font-mono font-semibold">{{ $santri->nis }}</td>
                                    <td class="p-4 font-medium text-gray-900 dark:text-white">{{ $santri->nama_lengkap }}</td>
                                    <td class="p-4">{{ $santri->kelas->nama_kelas ?? '-' }}</td>
                                    <td class="p-4">{{ $santri->kamar->nama_kamar ?? '-' }}</td>
                                    <td class="p-4">
                                        @if($santri->status === 'aktif')
                                            <span class="px-2.5 py-1 bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-bold uppercase">Aktif</span>
                                        @elseif($santri->status === 'lulus')
                                            <span class="px-2.5 py-1 bg-blue-50 dark:bg-blue-950 text-blue-700 dark:text-blue-300 rounded-full text-xs font-bold uppercase">Lulus</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-300 rounded-full text-xs font-bold uppercase">Pindah</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('santri.show', $santri) }}" class="p-2 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950 rounded-lg transition" title="Lihat Profil">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('santri.edit', $santri) }}" class="p-2 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950 rounded-lg transition" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            </a>
                                            <form action="{{ route('santri.destroy', $santri) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data santri ini?')" class="inline">
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
                                    <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                        Data santri tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($santris->hasPages())
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600">
                        {{ $santris->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
