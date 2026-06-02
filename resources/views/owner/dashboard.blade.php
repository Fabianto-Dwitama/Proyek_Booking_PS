<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        🎮 Dashboard Owner Rental Playstation
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Welcome Card -->
        <div class="bg-white shadow rounded p-6 mb-6">

            <h3 class="text-2xl font-bold mb-2">
                Selamat Datang Owner 👋
            </h3>

            <p class="text-gray-600">
                Kelola Playstation, pantau booking pelanggan, dan verifikasi pembayaran dari dashboard ini.
            </p>

        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Total Playstation
                </h4>

                <p class="text-4xl font-bold text-blue-600 mt-2">
                    {{ $jumlahPlaystation }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Total Booking
                </h4>

                <p class="text-4xl font-bold text-green-600 mt-2">
                    {{ $jumlahBooking }}
                </p>

            </div>

        </div>

        <!-- Menu Owner -->
        <div class="bg-white shadow rounded p-6">

            <h3 class="text-lg font-bold mb-4">
                Menu Owner
            </h3>

            <div class="flex flex-wrap gap-3">

                <a
                    href="{{ route('playstations.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded"
                >
                    🎮 Kelola Playstation
                </a>

                <a
                    href="/owner/bookings"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded"
                >
                    📅 Data Booking
                </a>

                <a
                    href="/owner/payments"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded"
                >
                    💰 Verifikasi Pembayaran
                </a>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
