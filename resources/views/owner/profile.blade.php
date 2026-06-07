<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        🏢 Profil Rental Saya
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <a
            href="/owner/dashboard"
            class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
        >
            ← Kembali ke Dashboard
        </a>

        @if(session('success'))

            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>

        @endif

        <div class="bg-white shadow rounded-lg p-6">

            <form action="/owner/profile" method="POST">

                @csrf

                <h3 class="text-xl font-bold mb-4">
                    🏢 Informasi Rental
                </h3>

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Nama Rental
                    </label>

                    <input
                        type="text"
                        name="nama_rental"
                        value="{{ $owner->nama_rental }}"
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Alamat Rental
                    </label>

                    <textarea
                        name="alamat_rental"
                        rows="3"
                        class="w-full border rounded px-3 py-2"
                    >{{ $owner->alamat_rental }}</textarea>

                </div>

                <div class="mb-6">

                    <label class="block font-medium mb-2">
                        Deskripsi Rental
                    </label>

                    <textarea
                        name="deskripsi_rental"
                        rows="3"
                        class="w-full border rounded px-3 py-2"
                    >{{ $owner->deskripsi_rental }}</textarea>

                </div>

                <hr class="my-6">

                <h3 class="text-xl font-bold mb-4">
                    📱 Kontak Owner
                </h3>

                <div class="mb-6">

                    <label class="block font-medium mb-2">
                        Nomor WhatsApp
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ $owner->whatsapp }}"
                        placeholder="628xxxxxxxxxx"
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

                <hr class="my-6">

                <h3 class="text-xl font-bold mb-4">
                    💳 Metode Pembayaran
                </h3>

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Rekening BCA
                    </label>

                    <input
                        type="text"
                        name="rekening_bca"
                        value="{{ $owner->rekening_bca }}"
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Rekening BNI
                    </label>

                    <input
                        type="text"
                        name="rekening_bni"
                        value="{{ $owner->rekening_bni }}"
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        DANA
                    </label>

                    <input
                        type="text"
                        name="dana"
                        value="{{ $owner->dana }}"
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

                <div class="mb-6">

                    <label class="block font-medium mb-2">
                        GoPay
                    </label>

                    <input
                        type="text"
                        name="gopay"
                        value="{{ $owner->gopay }}"
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded"
                >
                    💾 Simpan Profil Rental
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>