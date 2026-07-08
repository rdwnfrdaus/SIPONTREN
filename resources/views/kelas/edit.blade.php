<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Kelas') }}: {{ $kelas->nama_kelas }}
            </h2>
            <a href="{{ route('kelas.index') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl text-sm transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 space-y-4">
                <form action="{{ route('kelas.update', $kelas) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nama Kelas</label>
                        <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tingkat / Marhalah</label>
                        <select name="tingkat" required class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            <option value="Ula" {{ $kelas->tingkat === 'Ula' ? 'selected' : '' }}>Ula (Dasar)</option>
                            <option value="Wustha" {{ $kelas->tingkat === 'Wustha' ? 'selected' : '' }}>Wustha (Menengah)</option>
                            <option value="Ulya" {{ $kelas->tingkat === 'Ulya' ? 'selected' : '' }}>Ulya (Atas)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Wali Kelas (Ustadz)</label>
                        <select name="wali_kelas_id" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            <option value="">Pilih Wali Kelas</option>
                            @foreach($ustadz as $u)
                                <option value="{{ $u->id }}" {{ $kelas->wali_kelas_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
