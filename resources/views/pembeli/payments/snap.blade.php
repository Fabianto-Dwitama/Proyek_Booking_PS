@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">

    <div class="bg-white shadow rounded p-6">

        <h2 class="text-2xl font-bold mb-4">
            Pembayaran Midtrans
        </h2>

        <p class="mb-2">
            <strong>ID Transaksi:</strong>
            {{ $payment->transaction_id }}
        </p>

        <p class="mb-6">
            <strong>Total:</strong>
            Rp {{ number_format($payment->nominal, 0, ',', '.') }}
        </p>

        <button
            id="pay-button"
            class="bg-blue-600 text-white px-6 py-3 rounded"
        >
            BAYAR SEKARANG
        </button>

    </div>

</div>

@endsection

@push('scripts')

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>

document.getElementById('pay-button').onclick = function () {

    snap.pay(
        "{{ $payment->snap_token }}",
        {

            onSuccess: function(result) {

                alert('Pembayaran berhasil');

                window.location.href =
                    "{{ route('pembeli.bookings.index') }}";
            },

            onPending: function(result) {

                alert('Menunggu pembayaran');
            },

            onError: function(result) {

                alert('Pembayaran gagal');
            },

            onClose: function() {

                alert('Popup pembayaran ditutup');
            }

        }
    );

};

</script>

@endpush