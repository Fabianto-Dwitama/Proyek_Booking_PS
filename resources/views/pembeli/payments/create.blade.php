<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        💳 Pembayaran Booking
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        <a
            href="{{ route('bookings.index') }}"
            class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
        >
            ← Kembali ke Booking Saya
        </a>

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Informasi Booking -->
            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">
                    📋 Detail Booking
                </h3>

                <div class="space-y-3">

                    <p>
                        <strong>Playstation:</strong>
                        {{ $booking->playstation->nomor_ps }}
                    </p>

                    <p>
                        <strong>Tipe:</strong>
                        {{ $booking->playstation->tipe_ps }}
                    </p>

                    <p>
                        <strong>Tanggal:</strong>
                        {{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}
                    </p>

                    <p>
                        <strong>Jam:</strong>
                        {{ $booking->jam_mulai }}
                    </p>

                    <p>
                        <strong>Durasi:</strong>
                        {{ $booking->durasi }} Jam
                    </p>

                    <hr>

                    <p class="text-xl font-bold text-green-600">
                        Total Bayar:
                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                    </p>

                </div>

            </div>

            <!-- Informasi Owner -->
            <div class="bg-yellow-50 border border-yellow-300 shadow rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">
                    👨‍💼 Informasi Owner
                </h3>

                <p>
                    <strong>Nama Owner:</strong><br>
                    {{ $booking->playstation->owner->name }}
                </p>

                <br>

                <p>
                    <strong>WhatsApp Owner:</strong><br>
                    {{ $booking->playstation->owner->no_wa }}
                </p>

                <br>

                <a
                    href="https://wa.me/{{ $booking->playstation->owner->no_wa }}"
                    target="_blank"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded"
                >
                    📱 Chat WhatsApp Owner
                </a>

                <div class="mt-5 p-4 bg-green-100 rounded">

                    <p class="font-semibold text-green-800">
                        Setelah transfer, kirim bukti pembayaran melalui WhatsApp Owner.
                    </p>

                </div>

            </div>

        </div>

        <!-- Form Pembayaran -->
        <div class="bg-white shadow rounded-lg p-6 mt-6">

            <h3 class="text-lg font-bold mb-4">
                💰 Konfirmasi Pembayaran
            </h3>

            <form action="{{ route('payments.store') }}" method="POST">

                @csrf

                <input
                    type="hidden"
                    name="booking_id"
                    value="{{ $booking->id }}"
                >

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Metode Pembayaran
                    </label>

                    <select
                        name="metode"
                        required
                        class="w-full border rounded px-3 py-2"
                    >
                        <option value="">Pilih Metode</option>
                        <option value="Transfer BCA">Transfer BCA</option>
                        <option value="Transfer BNI">Transfer BNI</option>
                        <option value="DANA">DANA</option>
                        <option value="GoPay">GoPay</option>
                    </select>

                </div>

                <div class="mb-6">

                    <label class="block font-medium mb-2">
                        Nominal Transfer
                    </label>

                    <input
                        type="number"
                        name="nominal"
                        value="{{ $booking->total_harga }}"
                        readonly
                        class="w-full border rounded px-3 py-2 bg-gray-100"
                    >

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded"
                >
                    Simpan Pembayaran
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>