<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        🎮 Dashboard Owner Rental Playstation
    </h2>
</x-slot>

<div class="py-6 bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Welcome Card -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-6">

            <h3 class="text-2xl font-bold text-gray-800 mb-2">
                Selamat Datang Owner 👋
            </h3>

            <p class="text-gray-600">
                Kelola Playstation, pantau booking pelanggan,
                dan verifikasi pembayaran dari dashboard ini.
            </p>

        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

            <div class="bg-white shadow-md rounded-xl p-6">

                <h4 class="text-gray-500 text-sm uppercase font-semibold">
                    Total Playstation
                </h4>

                <p class="text-4xl font-bold text-blue-600 mt-3">
                    {{ $jumlahPlaystation }}
                </p>

            </div>

            <div class="bg-white shadow-md rounded-xl p-6">

                <h4 class="text-gray-500 text-sm uppercase font-semibold">
                    Total Booking
                </h4>

                <p class="text-4xl font-bold text-green-600 mt-3">
                    {{ $jumlahBooking }}
                </p>

            </div>

            <div class="bg-white shadow-md rounded-xl p-6">

                <h4 class="text-gray-500 text-sm uppercase font-semibold">
                    Total Pendapatan
                </h4>

                <p class="text-4xl font-bold text-emerald-600 mt-3">
                    Rp {{ number_format($pendapatan,0,',','.') }}
                </p>

            </div>

            <div class="bg-white shadow-md rounded-xl p-6">

                <h4 class="text-gray-500 text-sm uppercase font-semibold">
                    Booking Pending
                </h4>

                <p class="text-4xl font-bold text-orange-500 mt-3">
                    {{ $bookingPending }}
                </p>

            </div>

        </div>

        <!-- Menu Owner -->
        <div class="bg-white shadow rounded p-6">

            <h3 class="text-lg font-bold mb-4">
                Menu Owner
            </h3>

            <div style="display:flex; gap:15px; flex-wrap:wrap;">

                <a href="{{ route('playstations.index') }}"
                style="
                        background:#2563eb;
                        color:white;
                        padding:12px 20px;
                        border-radius:8px;
                        text-decoration:none;
                        font-weight:bold;
                        display:flex;
                        align-items:center;
                        gap:10px;
                ">
                    🎮
                    <span style="color:white !important;">
                        Kelola Playstation
                    </span>
                </a>

                <a href="/owner/bookings"
                style="
                        background:#16a34a;
                        color:white;
                        padding:12px 20px;
                        border-radius:8px;
                        text-decoration:none;
                        font-weight:bold;
                        display:flex;
                        align-items:center;
                        gap:10px;
                ">
                    📅
                    <span style="color:white !important;">
                        Kelola Booking
                    </span>
                </a>

                <a href="/owner/payments"
                style="
                        background:#9333ea;
                        color:white;
                        padding:12px 20px;
                        border-radius:8px;
                        text-decoration:none;
                        font-weight:bold;
                        display:flex;
                        align-items:center;
                        gap:10px;
                ">
                    💰
                    <span style="color:white !important;">
                        Verifikasi Pembayaran
                    </span>
                </a>

                <a href="/owner/profile"
                style="
                        background:#4f46e5;
                        color:white;
                        padding:12px 20px;
                        border-radius:8px;
                        text-decoration:none;
                        font-weight:bold;
                        display:flex;
                        align-items:center;
                        gap:10px;
                ">
                    ⚙️
                    <span style="color:white !important;">
                        Data Pembayaran
                    </span>
                </a>

            </div>

        </div>

    </div>

</div>

</x-app-layout>

