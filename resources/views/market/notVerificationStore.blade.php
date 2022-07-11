<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Toko') }}
        </h2>
    </x-slot> --}}

    <div class="py-2" style="background-color: white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10 w-full">
                <div class="grid justify-items-center mt-2">
                    <img style="width: 40%;" src="/images/notRegistration.svg" alt="store">
                    <p class="font-bold text-xl text-gray-500 mt-5">Akun toko anda belum verifikasi</p>
                    <p class="font-bold text-xl text-gray-500">Mohon tunggu verifikasi dari admin</p><span
                        style="color: green;font-size: 20px;font-weight: bold">Markettani</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
