@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-8">

<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard Admin
    </h1>

    <p class="text-gray-500 mt-2">
        Monitoring sistem Booking Rental Playstation
    </p>

</div>

<!-- Statistik -->

<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-xl shadow p-6">

        <p class="text-gray-500 text-sm">
            Total Booking
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalBooking }}
        </h2>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <p class="text-gray-500 text-sm">
            Total Playstation
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalPlaystation }}
        </h2>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <p class="text-gray-500 text-sm">
            Pembayaran Verified
        </p>

        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $totalPayment }}
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

<!-- Booking Terbaru -->

<div class="bg-white shadow rounded-xl overflow-hidden">

    <div class="p-6 border-b">

        <h2 class="text-xl font-semibold">
            Booking Terbaru
        </h2>

    </div>

    <table class="min-w-full">

        <thead class="bg-gray-50">

            <tr>

                <th class="px-6 py-3 text-left">
                    No
                </th>

                <th class="px-6 py-3 text-left">
                    Pelanggan
                </th>

                <th class="px-6 py-3 text-left">
                    Playstation
                </th>

                <th class="px-6 py-3 text-left">
                    Tanggal
                </th>

                <th class="px-6 py-3 text-left">
                    Jam
                </th>

                <th class="px-6 py-3 text-left">
                    Status
                </th>

            </tr>

        </thead>

        <tbody class="divide-y">

            @forelse($latestBookings as $booking)

            <tr>

                <td class="px-6 py-4">
                    {{ $loop->iteration }}
                </td>

                <td class="px-6 py-4">
                    {{ $booking->user?->name ?? '-' }}
                </td>

                <td class="px-6 py-4">
                    {{ $booking->playstation?->nomor_ps ?? '-' }}
                </td>

                <td class="px-6 py-4">
                    {{ $booking->tanggal }}
                </td>

                <td class="px-6 py-4">
                    {{ $booking->jam_mulai }}
                </td>

                <td class="px-6 py-4">

                    @if($booking->status === 'confirmed')

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                            Confirmed
                        </span>

                    @elseif($booking->status === 'pending')

                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                            Pending
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                            Cancelled
                        </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    Belum ada data booking
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<!-- Tombol Cepat -->

<div class="mt-8 flex flex-wrap gap-4">

    <a
        href="{{ route('admin.reports') }}"
        class="px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
    >
        Lihat Laporan
    </a>

</div>

@endsection
