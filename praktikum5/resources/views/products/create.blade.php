<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot> --}}
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-300">
                    <!-- Header -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-300">Tambah Produk Baru</h1>
                        <p class="text-gray-600 mt-1 dark:text-gray-400">Masukkan detail produk untuk inventaris toko</p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <h3 class="font-bold mb-2">Terjadi kesalahan:</h3>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf

                        <!-- Nama Produk -->
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Nama Produk *</label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}" placeholder="Contoh: Laptop Dell Inspiron" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                placeholder="Deskripsi detail produk (opsional)">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga dan Stok (2 kolom) -->
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <!-- Harga -->
                            <div>
                                <label for="price" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Harga (Rp) *</label>
                                <input type="number" name="price" id="price" step="0.01" min="0"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('price') border-red-500 @enderror"
                                    value="{{ old('price') }}" placeholder="100000" required>
                                @error('price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div>
                                <label for="quantity" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Jumlah Stok *</label>
                                <input type="number" name="quantity" id="quantity" min="0"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('quantity') border-red-500 @enderror"
                                    value="{{ old('quantity') }}" placeholder="50" required>
                                @error('quantity')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- SKU dan Kategori (2 kolom) -->
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <!-- SKU -->
                            <div>
                                <label for="sku" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">SKU (Kode Produk)
                                    *</label>
                                <input type="text" name="sku" id="sku"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('sku') border-red-500 @enderror"
                                    value="{{ old('sku') }}" placeholder="SKU-0001-AB" required>
                                @error('sku')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="category" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Kategori</label>
                                <select name="category" id="category"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Elektronik" @selected(old('category') == 'Elektronik')>Elektronik</option>
                                    <option value="Pakaian" @selected(old('category') == 'Pakaian')>Pakaian</option>
                                    <option value="Makanan" @selected(old('category') == 'Makanan')>Makanan</option>
                                    <option value="Peralatan" @selected(old('category') == 'Peralatan')>Peralatan</option>
                                    <option value="Lainnya" @selected(old('category') == 'Lainnya')>Lainnya</option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('products.index') }}"
                                class="px-6 py-2 bg-gray-300 text-gray-800 dark:bg-zinc-600 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-zinc-500 transition font-bold">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
