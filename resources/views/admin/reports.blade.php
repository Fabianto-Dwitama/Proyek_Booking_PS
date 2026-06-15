@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-8">

    <div class="mb-8">

        <h1 class="text-3xl font-bold">
            Laporan Sistem
        </h1>

        <p class="text-gray-500 mt-2">
            Ringkasan data Rental Playstation
        </p>

    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6">

            <p class="text-gray-500 text-sm">
                Total Playstation
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalPlaystations }}
            </h2>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <p class="text-gray-500 text-sm">
                Total Booking
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalBookings }}
            </h2>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <p class="text-gray-500 text-sm">
                Total Payment
            </p>

            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalPayments }}
            </h2>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <p class="text-gray-500 text-sm">
                Total Pendapatan
            </p>

            <h2 class="text-2xl font-bold text-indigo-600 mt-2">
                Rp {{ number_format($totalRevenue,0,',','.') }}
            </h2>

        </div>

    </div>

    <div class="mt-8">

        <a
            href="{{ route('admin.dashboard') }}"
            class="px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
        >
            ← Kembali ke Dashboard
        </a>

    </div>

</div>

@endsection