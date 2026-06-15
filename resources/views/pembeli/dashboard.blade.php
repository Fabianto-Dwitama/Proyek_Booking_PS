@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-8">

    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 text-white mb-8">

        <h1 class="text-4xl font-bold">
            Halo, {{ Auth::user()->name }} 👋
        </h1>

        <p class="mt-2 text-blue-100">
            Temukan rental Playstation terbaik di sekitarmu.
        </p>

    </div>

    <div class="grid md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total Booking</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Booking Aktif</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-gray-500">Total Pengeluaran</h3>
            <p class="text-3xl font-bold mt-2">Rp0</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold mb-4">
            Menu Cepat
        </h2>

        <div class="flex gap-4">

            <a href="{{ route('bookings.create') }}"
               class="bg-blue-600 text-white px-5 py-3 rounded-xl">
                Booking Sekarang
            </a>

            <a href="{{ route('pembeli.bookings.index') }}"
               class="bg-green-600 text-white px-5 py-3 rounded-xl">
                Booking Saya
            </a>

        </div>

    </div>

</div>

@endsection