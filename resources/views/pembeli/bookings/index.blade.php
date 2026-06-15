@extends('layouts.app')

@section('content')

<div class="bg-white shadow rounded-lg overflow-hidden">

    <table class="min-w-full divide-y divide-gray-200">

        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">No</th>
                <th class="px-6 py-3 text-left">Tanggal</th>
                <th class="px-6 py-3 text-left">Jam</th>
                <th class="px-6 py-3 text-left">Durasi</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Status Booking</th>
                <th class="px-6 py-3 text-left">Pembayaran</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">

            @forelse($bookings as $booking)

            <tr>

                <td class="px-6 py-4">
                    {{ $loop->iteration }}
                </td>

                <td class="px-6 py-4">
                    {{ $booking->tanggal }}
                </td>

                <td class="px-6 py-4">
                    {{ $booking->jam_mulai }}
                </td>

                <td class="px-6 py-4">
                    {{ $booking->durasi }} Jam
                </td>

                <td class="px-6 py-4">
                    Rp {{ number_format($booking->total_harga,0,',','.') }}
                </td>

                <td class="px-6 py-4">

                    @if($booking->status == 'confirmed')

                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">
                            Confirmed
                        </span>

                    @elseif($booking->status == 'pending')

                        <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded">
                            Pending
                        </span>

                    @else

                        <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded">
                            Cancelled
                        </span>

                    @endif

                </td>

                <td class="px-6 py-4">

                    @if(
                        $booking->payment &&
                        $booking->payment->status === 'verified'
                    )

                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">
                            Sudah Dibayar
                        </span>

                    @else

                        <a
                            href="{{ route('pembeli.payments.create', ['booking_id' => $booking->id]) }}"
                            class="inline-flex px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                        >
                            {{ $booking->payment ? 'Lanjutkan Pembayaran' : 'Bayar Sekarang' }}
                        </a>

                    @endif

                </td>

            </tr>

            @empty

            <tr>
                <td
                    colspan="7"
                    class="px-6 py-10 text-center text-gray-500"
                >
                    Belum ada booking.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection