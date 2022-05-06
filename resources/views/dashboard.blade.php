<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->roles == 'ADMIN')
                {{ __('Dashboard') }}
            @else
                {{ __('Dashboard Penjual') }}
            @endif
        </h2>
    </x-slot>

    @if (Auth::user()->roles == 'ADMIN')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-jet-welcome />
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
