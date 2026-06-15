@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-8">


<div class="bg-white shadow rounded-lg">

    <div class="border-b px-6 py-4">
        <h2 class="text-2xl font-bold">
            Pembayaran Booking
        </h2>
    </div>

    <div class="p-6">

        <table class="w-full">

            <tr>
                <td class="py-2 font-semibold">Tanggal</td>
                <td>{{ $booking->tanggal }}</td>
            </tr>

            <tr>
                <td class="py-2 font-semibold">Jam</td>
                <td>{{ $booking->jam_mulai }}</td>
            </tr>

            <tr>
                <td class="py-2 font-semibold">Durasi</td>
                <td>{{ $booking->durasi }} Jam</td>
            </tr>

            <tr>
                <td class="py-2 font-semibold">Total Bayar</td>
                <td>
                    Rp {{ number_format($booking->total_harga,0,',','.') }}
                </td>
            </tr>

        </table>

        <form
            action="{{ route('pembeli.payments.store') }}"
            method="POST"
            class="mt-6"
        >
            @csrf

            <input
                type="hidden"
                name="booking_id"
                value="{{ $booking->id }}"
            >

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                >
                    Bayar Sekarang
                </button>

                <a
                    href="{{ route('pembeli.bookings.index') }}"
                    class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>


</div>

@endsection
