@extends('layouts.app')

@section('content')

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Pembayaran Booking
            </h2>

            <div class="space-y-3">

                <p>
                    <strong>ID Booking:</strong>
                    {{ $booking->id }}
                </p>

                <p>
                    <strong>Tanggal:</strong>
                    {{ $booking->tanggal }}
                </p>

                <p>
                    <strong>Jam Mulai:</strong>
                    {{ $booking->jam_mulai }}
                </p>

                <p>
                    <strong>Durasi:</strong>
                    {{ $booking->durasi }} Jam
                </p>

                <p>
                    <strong>Total:</strong>
                    Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                </p>

            </div>

            <hr class="my-6">

            <form action="{{ route('pembeli.payments.store') }}" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="booking_id"
                    value="{{ $booking->id }}"
                >

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded"
                >
                    Bayar dengan Midtrans
                </button>
            </form>

        </div>
    </div>
</div>

@endsection