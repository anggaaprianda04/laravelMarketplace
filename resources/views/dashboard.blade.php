<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->roles == 'ADMIN')
                {{ __('Dashboard Markettani') }}
            @else
                {{ __('Dashboard Penjual Markettani') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-5">
        <div style="height: 150px" class="max-w-7xl mx-auto px-6">
            <div style="background-color: #d8d8d8;padding: 20px;height: 100%" class="overflow-hidden rounded-lg">
                <h1 style="font-size: 40px;font-weight: 600;color: #5d6469">Selamat Datang!</h1>
                @if (Auth::user()->roles == 'ADMIN')
                        <p style="font-weight: 600;color: #5d6469">Halaman administrator Markettani</p>
                    @else
                        <p style="font-weight: 600;color: #5d6469">Halaman dashboard penjual</p>
                    @endif
            </div>
        </div>
    </div>

    {{-- @if (Auth::user()->roles == 'ADMIN')
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <x-jet-welcome />
                </div>
            </div>
        </div>
    @endif --}}


</x-app-layout>
