@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-8">

<div class="mb-8">

    <h1 class="text-3xl font-bold">
        Dashboard Owner
    </h1>

    <p class="text-gray-500 mt-2">
        Ringkasan operasional Rental Playstation
    </p>

</div>

<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-6">

        <p class="text-gray-500 text-sm">
            Total Playstation
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $jumlahPlaystation }}
        </h2>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <p class="text-gray-500 text-sm">
            Total Booking
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $jumlahBooking }}
        </h2>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <p class="text-gray-500 text-sm">
            Playstation Tersedia
        </p>

        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $jumlahTersedia }}
        </h2>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <p class="text-gray-500 text-sm">
            Maintenance
        </p>

        <h2 class="text-4xl font-bold text-red-600 mt-2">
            {{ $jumlahMaintenance }}
        </h2>

    </div>

</div>

<div class="mt-8 bg-white rounded-xl shadow p-6">

    <h3 class="text-xl font-semibold mb-4">
        Total Pendapatan
    </h3>

    <p class="text-4xl font-bold text-indigo-600">
        Rp {{ number_format($totalPendapatan,0,',','.') }}
    </p>

</div>

<div class="mt-8 bg-white rounded-xl shadow p-6">

    <h3 class="text-xl font-semibold mb-4">
        Menu Owner
    </h3>

    <div class="flex flex-wrap gap-4">

        <a
            href="{{ route('owner.playstations.index') }}"
            class="px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
        >
            Kelola Playstation
        </a>

    </div>

</div>

</div>

@endsection
