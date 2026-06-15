@if(
    $booking->payment &&
    $booking->payment->status === 'verified'
)

    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">
        Sudah Dibayar
    </span>

@elseif(
    $booking->payment &&
    $booking->payment->status === 'pending'
)

    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded">
        Menunggu Pembayaran
    </span>

@else

    <a
        href="{{ route('pembeli.payments.create', ['booking_id' => $booking->id]) }}"
        class="inline-flex px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
    >
        Bayar Sekarang
    </a>

@endif