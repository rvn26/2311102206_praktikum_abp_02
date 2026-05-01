<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Inventaris Produk</h1>
                            <p class="text-gray-600 mt-1 dark:text-gray-400">Toko: Pak Cokomi & Mas Wowo</p>
                        </div>
                        <a href="{{ route('products.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                            + Tambah Produk
                        </a>
                    </div>

                    <!-- Flash Messages -->
                    @if ($message = Session::get('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ $message }}
                        </div>
                    @endif

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-zinc-800 border border-gray-200 dark:border-gray-600 rounded-lg ">
                            <thead class="bg-gray-100 dark:bg-zinc-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Nama Produk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Kategori</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        SKU</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Harga</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Stok</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y  divide-gray-200 dark:divide-gray-600">
                                @forelse($products as $key => $product)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                            <div class="font-medium">{{ $product->name }}</div>
                                            <div class="text-gray-500 text-xs">
                                                {{ Str::limit($product->description, 50) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            <span
                                                class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $product->category ?? 'N/A' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-mono dark:text-gray-100">
                                            {{ $product->sku }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            <span
                                                class="font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-100">
                                            @if ($product->quantity > 10)
                                                <span
                                                    class="px-3 py-1 bg-green-100 text-green-800 rounded-full">{{ $product->quantity }}</span>
                                            @elseif($product->quantity > 0)
                                                <span
                                                    class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">{{ $product->quantity }}</span>
                                            @else
                                                <span
                                                    class="px-3 py-1 bg-red-100 text-red-800 rounded-full">Kosong</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded transition inline-block">
                                                Edit
                                            </a>
                                            <button type="button"
                                                onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}')"
                                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded transition">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada produk. <a href="{{ route('products.create') }}"
                                                class="text-blue-600 hover:underline">Tambah sekarang</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>


                        </table>
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-zinc-800 dark:border-gray-600 dark:text-gray-300  ">
            <h3 class="text-lg font-medium text-gray-900 mb-4 dark:text-gray-300">Konfirmasi Hapus</h3>
            <p class="text-gray-700 mb-6 dark:text-gray-300">
                Apakah Anda yakin ingin menghapus produk <strong id="productName"></strong>? Tindakan ini tidak dapat
                dibatalkan.
            </p>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-800 dark:bg-zinc-600 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-zinc-500 transition">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Hapus Produk
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(productId, productName) {
            document.getElementById('productName').textContent = productName;
            document.getElementById('deleteForm').action = `/products/${productId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
