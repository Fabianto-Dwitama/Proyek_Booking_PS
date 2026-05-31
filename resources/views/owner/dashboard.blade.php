<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard Owner Rental PS</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow">

                <h3 class="text-lg font-bold">
                    Selamat Datang Owner
                </h3>

                <p>
                    Kelola Playstation dan pantau pemesanan rental.
                </p>

                <hr class="my-4">

                <p>
                    Total Playstation:
                    <strong>
                        {{ $jumlahPlaystation }}
                    </strong>
                </p>

                <p>
                    Total Booking:
                    <strong>
                        {{ $jumlahBooking }}
                    </strong>
                </p>

                <br>

                <a
                    href="{{ route('playstations.index') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Kelola Playstation
                </a>

            </div>

        </div>
    </div>
</x-app-layout>