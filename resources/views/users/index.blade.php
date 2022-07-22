<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua User') }}
        </h2>
    </x-slot>

    <div class="py-2" style="background-color: white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('users.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                    + Buat User
                </a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500">
                                        <th scope="col" class="px-6 py-3 text-left font-bold">No</th>
                                        <th scope="col" class="px-6 py-3 text-center font-bold">Image</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Username</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left font-bold">Role</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $num = 1;
                                    @endphp
                                    @forelse ($user as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                                {{ $num++ }}</td>
                                            <td class="flex justify-center">
                                                <div class="grow-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full mt-4"
                                                        src="{{ $item->profile_photo_url }}" alt="">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->username }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $item->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->roles }}</td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-center gap-1 font-bold text-center">
                                                    <a style="background-color: #efa961"
                                                        href="{{ route('users.edit', $item->id) }}"
                                                        class="text-white px-2 py-2 rounded w-20">Edit</a>
                                                    <form action="{{ route('users.destroy', $item->id) }}"
                                                        method="POST" class="inline-block">
                                                        {!! method_field('delete') . csrf_field() !!}
                                                        <button style="background-color: #ff928a;color: darkred"
                                                            type="submit" class="font-bold px-2 py-2 rounded w-20">
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
