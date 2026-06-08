<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard Pembeli</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow">

                <h3 class="text-lg font-bold">
                    Selamat Datang Pembeli
                </h3>

                <p>
                    Silakan melakukan booking Playstation.
                </p>

                <br>

                <a
                    href="{{ route('bookings.create') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded"
                >
                    Booking Playstation
                </a>

                <a
                    href="{{ route('bookings.index') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Daftar Booking Saya
                </a>

            </div>

        </div>
    </div>
</x-app-layout>