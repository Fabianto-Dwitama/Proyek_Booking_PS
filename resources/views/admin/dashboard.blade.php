<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        📊 Dashboard Admin
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Header -->

        <div class="bg-gradient-to-r from-slate-800 to-slate-900 text-white rounded-xl shadow-lg p-8 mb-6">

            <h1 class="text-3xl font-bold">
                Dashboard Administrator
            </h1>

            <p class="mt-2 text-slate-200">
                Monitoring seluruh aktivitas Rental Playstation.
            </p>

        </div>

        <!-- Statistik -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

            <div class="bg-white rounded-xl shadow p-6">

                <p class="text-gray-500 text-sm">
                    Total User
                </p>

                <h3 class="text-4xl font-bold text-blue-600 mt-2">
                    {{ $jumlahUser }}
                </h3>

            </div>

            <div class="bg-white rounded-xl shadow p-6">

                <p class="text-gray-500 text-sm">
                    Total Playstation
                </p>

                <h3 class="text-4xl font-bold text-green-600 mt-2">
                    {{ $jumlahPlaystation }}
                </h3>

            </div>

            <div class="bg-white rounded-xl shadow p-6">

                <p class="text-gray-500 text-sm">
                    Total Booking
                </p>

                <h3 class="text-4xl font-bold text-yellow-500 mt-2">
                    {{ $jumlahBooking }}
                </h3>

            </div>

            <div class="bg-white rounded-xl shadow p-6">

                <p class="text-gray-500 text-sm">
                    Total Transaksi
                </p>

                <h3 class="text-4xl font-bold text-purple-600 mt-2">
                    {{ $jumlahPayment }}
                </h3>

            </div>

        </div>

        <!-- Pendapatan -->

        <div class="bg-white rounded-xl shadow p-6 mb-6">

            <h3 class="text-lg font-bold text-gray-700">
                💰 Total Pendapatan Rental
            </h3>

            <p class="text-4xl font-bold text-green-600 mt-3">
                Rp {{ number_format($pendapatan,0,',','.') }}
            </p>

        </div>

        <!-- Menu -->

        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="text-xl font-bold mb-5">
                🚀 Menu Administrator
            </h3>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">

                <a
                    href="/admin/users"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-center py-4 rounded-lg font-semibold"
                >
                    👥 Kelola User
                </a>

                <a
                    href="/admin/bookings"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-center py-4 rounded-lg font-semibold"
                >
                    📅 Data Booking
                </a>

                <a
                    href="/admin/transactions"
                    class="bg-purple-600 hover:bg-purple-700 text-white text-center py-4 rounded-lg font-semibold"
                >
                    💳 Transaksi
                </a>

                <a
                    href="/owner/profile"
                    class="bg-green-600 hover:bg-green-700 text-white text-center py-4 rounded-lg font-semibold"
                >
                    🏢 Profil Rental
                </a>

            </div>

        </div>

    </div>

</div>

</x-app-layout>