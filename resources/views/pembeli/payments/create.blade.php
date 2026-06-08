@if(session('error'))

    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        {{ session('error') }}
    </div>

@endif

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

        <!-- Detail Booking -->
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

        <!-- Informasi Rental -->
        <div class="bg-yellow-50 border border-yellow-300 shadow rounded-lg p-6">

            <h3 class="text-xl font-bold mb-4">
                🏢 Informasi Rental
            </h3>

            <p>
                <strong>Nama Rental:</strong><br>
                {{ $owner->nama_rental ?? '-' }}
            </p>

            <br>

            <p>
                <strong>Owner:</strong><br>
                {{ $owner->name }}
            </p>

            <br>

            <p>
                <strong>Alamat Rental:</strong><br>
                {{ $owner->alamat_rental ?? '-' }}
            </p>

            <br>

            <p>
                <strong>Deskripsi:</strong><br>
                {{ $owner->deskripsi_rental ?? '-' }}
            </p>

            <br>

            <p>
                <strong>WhatsApp:</strong><br>
                {{ $owner->whatsapp ?? '-' }}
            </p>

            <hr class="my-4">

            @if($owner->rekening_bca)
                <p class="mb-3">
                    <strong>🏦 Transfer BCA</strong><br>
                    {{ $owner->rekening_bca }}
                </p>
            @endif

            @if($owner->rekening_bni)
                <p class="mb-3">
                    <strong>🏦 Transfer BNI</strong><br>
                    {{ $owner->rekening_bni }}
                </p>
            @endif

            @if($owner->dana)
                <p class="mb-3">
                    <strong>💙 DANA</strong><br>
                    {{ $owner->dana }}
                </p>
            @endif

            @if($owner->gopay)
                <p class="mb-3">
                    <strong>🟢 GoPay</strong><br>
                    {{ $owner->gopay }}
                </p>
            @endif

            <a
                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $owner->whatsapp) }}?text=Saya%20sudah%20melakukan%20pembayaran%20untuk%20booking%20ID%20{{ $booking->id }}"
                target="_blank"
                class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded"
            >
                📱 Kirim Bukti Pembayaran
            </a>

            <div class="mt-5 p-4 bg-green-100 rounded">

                <p class="font-semibold text-green-800">
                    Setelah transfer, kirim screenshot bukti pembayaran ke WhatsApp Owner agar pembayaran dapat diverifikasi.
                </p>

            </div>

        </div>

    </div>

    <!-- Form Pembayaran -->
    <div class="bg-white shadow rounded-lg p-6 mt-6">

        <h3 class="text-lg font-bold mb-4">
            💰 Konfirmasi Pembayaran
        </h3>

        <form
            action="{{ route('payments.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

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

                    @if($owner->rekening_bca)
                        <option value="Transfer BCA">Transfer BCA</option>
                    @endif

                    @if($owner->rekening_bni)
                        <option value="Transfer BNI">Transfer BNI</option>
                    @endif

                    @if($owner->dana)
                        <option value="DANA">DANA</option>
                    @endif

                    @if($owner->gopay)
                        <option value="GoPay">GoPay</option>
                    @endif

                </select>

            </div>

            <div class="mb-4">

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

            <div class="mb-6">

                <label class="block font-medium mb-2">
                    Upload Bukti Transfer
                </label>

                <input
                    type="file"
                    name="bukti_transfer"
                    accept="image/png,image/jpeg,image/jpg"
                    required
                    class="w-full border rounded px-3 py-2"
                >

                <p class="text-sm text-gray-500 mt-2">
                    Upload screenshot transfer (JPG, JPEG, PNG maksimal 2MB)
                </p>

            </div>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded"
            >
                💾 Simpan Pembayaran
            </button>

        </form>

    </div>

</div>

</div>

</x-app-layout>
