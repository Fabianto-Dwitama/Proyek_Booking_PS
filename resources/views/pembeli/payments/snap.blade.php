@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto py-8">

    <div class="bg-white shadow rounded-lg">

        <div class="border-b px-6 py-4">

            <h2 class="text-xl font-semibold">
                Pembayaran Midtrans
            </h2>

        </div>

        <div class="p-6">

            <p class="text-gray-600 mb-4">
                Silakan lanjutkan pembayaran booking Anda.
            </p>

            <div
                class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded mb-4"
            >
                <strong>Transaction ID:</strong>
                {{ $payment->transaction_id }}
            </div>

            <button
                id="pay-button"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
            >
                Bayar Sekarang
            </button>

        </div>

    </div>

</div>

<script
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
document
.getElementById('pay-button')
.addEventListener('click', function () {

    snap.pay(
        "{{ $payment->snap_token }}",
        {
            onSuccess: function(result) {

                window.location.href =
                "{{ route('pembeli.bookings.index') }}";

            },

            onPending: function(result) {

                window.location.href =
                "{{ route('pembeli.bookings.index') }}";

            },

            onError: function(result) {

                alert('Pembayaran gagal');

            }
        }
    );

});
</script>

@endsection