<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        📊 Dashboard Admin
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Welcome Card -->
        <div class="bg-white shadow rounded p-6 mb-6">

            <h3 class="text-2xl font-bold mb-2">
                Selamat Datang Admin 👋
            </h3>

            <p class="text-gray-600">
                Monitoring sistem Booking Rental Playstation.
            </p>

        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Total User
                </h4>

                <p class="text-4xl font-bold text-blue-600 mt-2">
                    {{ $jumlahUser }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Total Owner
                </h4>

                <p class="text-4xl font-bold text-green-600 mt-2">
                    {{ $jumlahOwner }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Total Booking
                </h4>

                <p class="text-4xl font-bold text-yellow-600 mt-2">
                    {{ $jumlahBooking }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Total Payment
                </h4>

                <p class="text-4xl font-bold text-purple-600 mt-2">
                    {{ $jumlahPayment }}
                </p>

            </div>

        </div>

        <!-- Menu Admin -->
        <div class="bg-white shadow rounded p-6">

            <h3 class="text-lg font-bold mb-4">
                Menu Admin
            </h3>

            <div class="flex flex-wrap gap-3">

                <a
                    href="/admin/users"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded"
                >
                    👥 Kelola User
                </a>

                <a
                    href="/admin/owners"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded"
                >
                    🏢 Kelola Owner
                </a>

                <a
                    href="/admin/bookings"
                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-5 py-3 rounded"
                >
                    📅 Data Booking
                </a>

                <a
                    href="/admin/transactions"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded"
                >
                    💳 Laporan Transaksi
                </a>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
