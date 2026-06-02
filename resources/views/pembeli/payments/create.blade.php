<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        💳 Upload Bukti Pembayaran
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <a
            href="{{ route('bookings.index') }}"
            class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
        >
            ← Kembali ke Booking Saya
        </a>

        @if(session('success'))

            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>

        @endif

        <div class="bg-yellow-50 border border-yellow-300 rounded p-4 mb-6">

            <h3 class="font-bold text-lg mb-3">
                Informasi Pembayaran
            </h3>

            <p>
                <strong>Transfer BCA</strong><br>
                1234567890<br>
                A/N Rental Playstation
            </p>

            <br>

            <p>
                <strong>Transfer BNI</strong><br>
                9876543210<br>
                A/N Rental Playstation
            </p>

            <br>

            <p>
                <strong>DANA</strong><br>
                081234567890
            </p>

            <br>

            <p>
                <strong>GoPay</strong><br>
                081234567890
            </p>

        </div>

        <div class="bg-white shadow rounded p-6">

            <form
                action="{{ route('payments.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Booking ID
                    </label>

                    <input
                        type="number"
                        name="booking_id"
                        value="{{ $booking_id }}"
                        readonly
                        class="w-full border rounded px-3 py-2 bg-gray-100"
                    >

                </div>

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Metode Pembayaran
                    </label>

                    <select
                        name="metode"
                        required
                        class="w-full border rounded px-3 py-2"
                    >

                        <option value="">
                            -- Pilih Metode Pembayaran --
                        </option>

                        <option value="Transfer BCA">
                            Transfer BCA
                        </option>

                        <option value="Transfer BNI">
                            Transfer BNI
                        </option>

                        <option value="DANA">
                            DANA
                        </option>

                        <option value="GoPay">
                            GoPay
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Upload Bukti Transfer
                    </label>

                    <input
                        type="file"
                        name="bukti_transfer"
                        required
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
                >
                    Upload Bukti Pembayaran
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
