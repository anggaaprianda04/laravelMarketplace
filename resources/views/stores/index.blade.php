<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Toko') }}
        </h2>
    </x-slot>

    <div class="py-2" style="background-color: white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('stores.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                    + Buat Toko
                </a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto">
                  <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                      <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr class="text-green-500">
                            <th scope="col" class="px-6 py-3 text-left font-bold">No</th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Desa  </th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Alamat</th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Nama Rekening</th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Nomor Rekening</th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Verifikasi Toko</th>
                            <th scope="col" class="relative px-6 py-3">
                              <span class="sr-only">Edit</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                              $num = 1;
                            @endphp
                            @forelse ($stores as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $num++ }}</td>
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
                                    <div style="background-color: #70ff81" class="text-sm font-bold text-white text-center p-2 rounded">{{ $item->verification_store ? "true" : "false" }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-center gap-1 font-bold text-center">
                                        <a style="background-color: #efa961" href="{{ route('users.edit', $item->id) }}" class="text-white px-2 py-2 rounded w-20">Edit</a>
                                        <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="inline-block">
                                          {!! method_field('delete') . csrf_field() !!}
                                          <button style="background-color: #ff928a;color: darkred" type="submit" class="font-bold px-2 py-2 rounded w-20">
                                              Hapus
                                          </button>
                                      </form>
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
