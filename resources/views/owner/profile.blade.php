<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ⚙️ Data Pembayaran Owner
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

        <div class="bg-white shadow rounded p-6">

            <h3 class="text-lg font-bold mb-6">
                Informasi Pembayaran Rental
            </h3>

            <form action="/owner/profile" method="POST">

                @csrf

                <div class="mb-4">

                    <label class="block font-medium mb-2">
                        Nomor WhatsApp
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ $owner->whatsapp }}"
                        class="w-full border rounded px-3 py-2"
                    >

                </div>

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
                        Nomor DANA
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
                        Nomor GoPay
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
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded"
                >
                    Simpan Data Pembayaran
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>