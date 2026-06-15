@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-8">

<div class="bg-white shadow rounded-lg">

    <div class="border-b px-6 py-4">
        <h2 class="text-2xl font-bold">
            Riwayat Pembayaran
        </h2>
    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">

                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Booking</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Metode</th>
                </tr>

            </thead>

            <tbody class="bg-white divide-y divide-gray-200">

            @forelse($payments as $payment)

                <tr>

                    <td class="px-6 py-4">
                        {{ $payment->id }}
                    </td>

                    <td class="px-6 py-4">
                        Booking #{{ $payment->booking_id }}
                    </td>

                    <td class="px-6 py-4">
                        Rp {{ number_format($payment->booking?->total_harga ?? 0,0,',','.') }}
                    </td>

                    <td class="px-6 py-4">

                        @if($payment->status == 'verified')

                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">
                                Verified
                            </span>

                        @elseif($payment->status == 'pending')

                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded">
                                Pending
                            </span>

                        @else

                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded">
                                Failed
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4">
                        {{ $payment->metode }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center py-4">
                        Belum ada pembayaran
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection
