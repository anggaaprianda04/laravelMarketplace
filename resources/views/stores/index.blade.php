<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Toko') }}
        </h2>
    </x-slot>

    <div class="py-2 overflow-auto" style="background-color: white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" class="px-6 py-3 text-left font-bold">No</th>
                                        {{-- <th scope="col" class="px-6 py-3 text-left font-bold">Gambar</th> --}}
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Toko</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Desa </th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Alamat</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Deskripsi</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Nama Rekening</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Nomor Rekening</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Verifikasi</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Aksi</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $num = 1;
                                    @endphp
                                    @forelse ($stores as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ $num++ }}</td>
                                            {{-- <td class="flex justify-center">
                                                <div class="grow-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full mt-4"
                                                        src="{{ Storage::url($item->image) }}" alt="toko">
                                                </div>
                                            </td> --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->name_store }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->village }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $item->address }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $item->description }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $item->account_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $item->account_number }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div style="background-color: #b6d7a8"
                                                    class="text-sm font-bold text-white text-center p-2 rounded">
                                                    <p style="color: #38761d">
                                                        {{ $item->verification_store ? 'ya' : 'tidak' }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-center gap-1 font-bold text-center">
                                                    <a style="background-color: #efa961"
                                                        href="{{ route('stores.edit', $item->id) }}"
                                                        class="text-white px-2 py-2 rounded w-20">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="border text-center p-5">
                                                Data Tidak Ditemukan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
