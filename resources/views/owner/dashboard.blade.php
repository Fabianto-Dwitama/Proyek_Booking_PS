<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        🎮 Dashboard Owner
    </h2>
</x-slot>

<div class="py-6">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Header Rental -->

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl shadow-lg p-8 mb-6">

        <h1 class="text-3xl font-bold">
            {{ auth()->user()->nama_rental ?? 'Rental Playstation' }}
        </h1>

        <p class="mt-3 text-blue-100">
            {{ auth()->user()->deskripsi_rental ?? 'Kelola rental Playstation Anda dari dashboard ini.' }}
        </p>

    </div>

    <!-- Statistik -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white shadow rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Playstation
                    </p>

                    <h3 class="text-4xl font-bold text-blue-600 mt-2">
                        {{ $jumlahPlaystation }}
                    </h3>

                </div>

                <div class="text-5xl">
                    🎮
                </div>

            </div>

        </div>

        <div class="bg-white shadow rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Booking
                    </p>

                    <h3 class="text-4xl font-bold text-green-600 mt-2">
                        {{ $jumlahBooking }}
                    </h3>

                </div>

                <div class="text-5xl">
                    📅
                </div>

            </div>

        </div>

        <div class="bg-white shadow rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 text-sm">
                        Booking Pending
                    </p>

                    <h3 class="text-4xl font-bold text-yellow-500 mt-2">
                        {{ $bookingPending }}
                    </h3>

                </div>

                <div class="text-5xl">
                    ⏳
                </div>

            </div>

        </div>

        <div class="bg-white shadow rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Pendapatan
                    </p>

                    <h3 class="text-2xl font-bold text-red-500 mt-2">
                        Rp {{ number_format($pendapatan,0,',','.') }}
                    </h3>

                </div>

                <div class="text-5xl">
                    💰
                </div>

            </div>

        </div>

    </div>

    <!-- Menu Cepat -->

    <div class="mb-8">

        <h3 class="text-xl font-bold mb-4">
            🚀 Menu Cepat
        </h3>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            <a
                href="/owner/playstations"
                class="bg-white shadow rounded-2xl p-6 hover:shadow-xl transition"
            >

                <div class="text-5xl mb-3">
                    🎮
                </div>

                <h4 class="font-bold text-lg">
                    Kelola Playstation
                </h4>

                <p class="text-gray-500 text-sm mt-2">
                    Tambah, edit, dan hapus Playstation.
                </p>

            </a>

            <a
                href="/owner/bookings"
                class="bg-white shadow rounded-2xl p-6 hover:shadow-xl transition"
            >

                <div class="text-5xl mb-3">
                    📅
                </div>

                <h4 class="font-bold text-lg">
                    Data Booking
                </h4>

                <p class="text-gray-500 text-sm mt-2">
                    Lihat semua booking pelanggan.
                </p>

            </a>

            <a
                href="/owner/payments"
                class="bg-white shadow rounded-2xl p-6 hover:shadow-xl transition"
            >

                <div class="text-5xl mb-3">
                    💳
                </div>

                <h4 class="font-bold text-lg">
                    Pembayaran
                </h4>

                <p class="text-gray-500 text-sm mt-2">
                    Verifikasi pembayaran pelanggan.
                </p>

            </a>

            <a
                href="/owner/profile"
                class="bg-white shadow rounded-2xl p-6 hover:shadow-xl transition"
            >

                <div class="text-5xl mb-3">
                    ⚙️
                </div>

                <h4 class="font-bold text-lg">
                    Profil Rental
                </h4>

                <p class="text-gray-500 text-sm mt-2">
                    Kelola rekening dan informasi rental.
                </p>

            </a>

        </div>

    </div>

    <!-- Informasi Rental -->

    <div class="grid lg:grid-cols-2 gap-6 mb-8">

        <div class="bg-white shadow rounded-2xl p-6">

            <h3 class="text-xl font-bold mb-4">
                🏢 Informasi Rental
            </h3>

            <div class="space-y-4">

                <div>
                    <strong>Nama Rental</strong>
                    <br>
                    {{ auth()->user()->nama_rental ?? '-' }}
                </div>

                <div>
                    <strong>Alamat Rental</strong>
                    <br>
                    {{ auth()->user()->alamat_rental ?? '-' }}
                </div>

                <div>
                    <strong>WhatsApp</strong>
                    <br>
                    {{ auth()->user()->whatsapp ?? '-' }}
                </div>

            </div>

        </div>

        <div class="bg-white shadow rounded-2xl p-6">

            <h3 class="text-xl font-bold mb-4">
                💳 Metode Pembayaran Aktif
            </h3>

            <div class="space-y-3">

                @if(auth()->user()->rekening_bca)
                    <p>🏦 BCA : {{ auth()->user()->rekening_bca }}</p>
                @endif

                @if(auth()->user()->rekening_bni)
                    <p>🏦 BNI : {{ auth()->user()->rekening_bni }}</p>
                @endif

                @if(auth()->user()->dana)
                    <p>💙 DANA : {{ auth()->user()->dana }}</p>
                @endif

                @if(auth()->user()->gopay)
                    <p>🟢 GoPay : {{ auth()->user()->gopay }}</p>
                @endif

                @if(
                    !auth()->user()->rekening_bca &&
                    !auth()->user()->rekening_bni &&
                    !auth()->user()->dana &&
                    !auth()->user()->gopay
                )

                    <div class="bg-red-100 text-red-700 p-4 rounded-lg">

                        Belum ada metode pembayaran yang diatur.

                    </div>

                @endif

            </div>

        </div>

    </div>

    <!-- Ringkasan Bisnis -->

    <div class="bg-white shadow rounded-2xl p-6">

        <h3 class="text-xl font-bold mb-4">
            📈 Ringkasan Bisnis
        </h3>

        <div class="grid md:grid-cols-3 gap-4">

            <div class="bg-green-50 border border-green-200 rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Pendapatan Saat Ini
                </p>

                <h4 class="text-2xl font-bold text-green-600 mt-2">
                    Rp {{ number_format($pendapatan,0,',','.') }}
                </h4>

            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Booking Pending
                </p>

                <h4 class="text-2xl font-bold text-yellow-600 mt-2">
                    {{ $bookingPending }}
                </h4>

            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Playstation Aktif
                </p>

                <h4 class="text-2xl font-bold text-blue-600 mt-2">
                    {{ $jumlahPlaystation }}
                </h4>

            </div>

        </div>

    </div>

</div>

</div>

</x-app-layout>
