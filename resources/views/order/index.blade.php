<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between" style="width: 100%">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transaksi') }}
            </h2>
            <a href="{{ route('order.create') }}" target="_blank" style="background-color: #6a7c87"
                class="p-2 w-20 text-white text-center font-bold rounded-md">Cetak</a>
        </div>
    </x-slot>

    <div class="py-2" style="background-color: white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto">
                    <div class="py-2 align-middle inline-block">
                        <div class="w-auto overflow-hidden border-gray-200 sm:rounded-lg">
                            <table class="w-96 divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" style="background-color: #6a7c87"
                                            class="px-6 py-3 text-left font-bold text-white">Total Produk Terjual</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold bg-gray-200">
                                            {{ $totalQuantity }} Produk
                                        </th>
                                    </tr>
                                </thead>
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" style="background-color: #6a7c87"
                                            class="text-white px-6 py-3 text-left font-bold">Total Produk</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold bg-gray-200">
                                            {{ $totalProduct }} Produk
                                    </tr>
                                </thead>
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" style="background-color: #6a7c87"
                                            class="px-6 py-3 text-left font-bold text-white">Total User</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold bg-gray-200">
                                            {{ $totalUser }} User
                                    </tr>
                                </thead>
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" style="background-color: #6a7c87"
                                            class="px-6 py-3 text-left font-bold text-white">Total Toko</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold bg-gray-200">
                                            {{ $totalMarket }} Toko
                                    </tr>
                                </thead>
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" class="px-6 py-3 text-left font-bold text-white"
                                            style="background-color: #6a7c87">Total Kategori</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold bg-gray-200">
                                            {{ $totalCategory }} Kategori
                                    </tr>
                                </thead>
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" style="background-color: #6a7c87"
                                            class="px-6 py-3 text-left font-bold text-white">Total Harga Semua Produk
                                            Terjual</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold bg-gray-200">
                                            Rp. {{ $totalPrice }}
                                    </tr>
                                </thead>

                            </table>
                            <div style="margin-top: 40px" class="shadow overflow-hidden  border-gray-200 sm:rounded-lg">

                                <table class="w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-500">
                                        <tr class="text-white">
                                            <th scope="col" class="px-6 py-3 text-left font-bold">No</th>
                                            <th scope="col" class="px-6 py-3 text-left font-bold">Alamat</th>
                                            <th scope="col" class="px-6 py-3 text-left font-bold">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left font-bold">Total Harga</th>
                                            <th scope="col" class="px-6 py-3 text-left font-bold">Waktu Transaksi
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $num = 1;
                                        @endphp
                                        @forelse ($order as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                                    {{ $num++ }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $item->address }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $item->status }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $item->total_price }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $item->created_at }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="border text-center p-5">
                                                    Data Tidak Ditemukan
                                                </td>
                                            </tr>
                                        @endforelse

                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
