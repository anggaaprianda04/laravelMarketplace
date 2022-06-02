<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Kategori') }}
        </h2>
    </x-slot>

    <div class="py-2" style="background-color: white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('category.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                    + Buat Kategori
                </a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto">
                  <div class="py-2 align-middle inline-block">
                    <div style="width: 70%" class="shadow overflow-hidden border-b w-auto border-gray-200 sm:rounded-lg">
                      <table style="width: 100%" class="divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr class="text-gray-500">
                            <th scope="col" class="px-6 py-3 text-left font-bold">No</th>
                            <th scope="col" class="px-6 py-3 text-left font-bold">Ketegori</th>
                            <th scope="col" class="relative px-6 py-3">
                              <span class="sr-only">Edit</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          @php
                              $num = 1;
                          @endphp
                          @forelse ($category as $item)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $num++ }}
                              </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                  <div class="flex justify-center gap-1 font-bold text-center">
                                    <a style="background-color: #efa961" href="{{ route('category.edit', $item->id) }}" class="text-white px-2 py-2 rounded w-20">Edit</a>
                                    <form action="{{ route('category.destroy', $item->id) }}" method="POST" class="inline-block">
                                      {!! method_field('delete') . csrf_field() !!}
                                      <button style="background-color: #ff928a;color: darkred" type="submit" class="font-bold px-2 py-2 rounded w-20">
                                          Hapus
                                      </button>
                                  </form>
                                </div>
                                </td>
                            </tr>
                          @empty

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
