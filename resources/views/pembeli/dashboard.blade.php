<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        🎮 Dashboard Pembeli
    </h2>
</x-slot>

<div class="py-6">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl shadow-lg p-8 mb-6">

        <h1 class="text-3xl font-bold mb-2">
            Selamat Datang 👋
        </h1>

        <p class="text-blue-100">
            Booking Playstation favoritmu dengan mudah dan cepat.
        </p>

    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-6">

        <a
            href="{{ route('bookings.create') }}"
            class="bg-white rounded-2xl shadow p-8 hover:shadow-xl transition"
        >

            <div class="text-5xl mb-3">
                🎮
            </div>

            <h3 class="text-xl font-bold mb-2">
                Booking Playstation
            </h3>

            <p class="text-gray-500">
                Pilih Playstation dan lakukan booking.
            </p>

        </a>

        <a
            href="{{ route('bookings.index') }}"
            class="bg-white rounded-2xl shadow p-8 hover:shadow-xl transition"
        >

            <div class="text-5xl mb-3">
                📅
            </div>

            <h3 class="text-xl font-bold mb-2">
                Booking Saya
            </h3>

            <p class="text-gray-500">
                Lihat status booking dan pembayaran.
            </p>

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow p-8">

        <h3 class="text-xl font-bold mb-4">
            Kenapa Memilih Rental Kami?
        </h3>

        <div class="grid md:grid-cols-4 gap-4">

            <div class="bg-gray-50 p-4 rounded-xl text-center">
                ❄️
                <p class="mt-2 font-medium">
                    Ruangan AC
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl text-center">
                📶
                <p class="mt-2 font-medium">
                    Wifi Gratis
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl text-center">
                🎮
                <p class="mt-2 font-medium">
                    Playstation Terbaru
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl text-center">
                🍔
                <p class="mt-2 font-medium">
                    Snack & Minuman
                </p>
            </div>

        </div>

    </div>

</div>


</div>

</x-app-layout>
