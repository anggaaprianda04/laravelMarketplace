<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Transaksi') }}
        </h2>
        <div class="mt-2 bg-gray-500 rounded-md font-semibold text-center"
            style="width: 15%;padding-left: 10px;padding-right: 10px;padding-top: 15px;padding-bottom: 15px">
            <p class="text-white">Total Pembelian <span class="font-bold">{{ $totalQuantity }}</span></p>
        </div>
    </x-slot>

    <div class="py-2" style="background-color: white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" class="px-6 py-3 text-left font-bold">No</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">ID</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Alamat</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Kuantitas</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Total Harga</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Waktu Transaksi</th>

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
                                                {{ $item->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->address }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $item->status }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->Quantity }}</td>
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
</x-app-layout>
