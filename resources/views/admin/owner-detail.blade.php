<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        👤 Detail Owner
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        <a
            href="/admin/owners"
            class="inline-block mb-4 bg-gray-500 text-white px-4 py-2 rounded"
        >
            ← Kembali
        </a>

        <div class="bg-white shadow rounded p-6 mb-6">

            <h3 class="text-2xl font-bold mb-4">
                {{ $owner->name }}
            </h3>

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <strong>Email:</strong><br>
                    {{ $owner->email }}
                </div>

                <div>
                    <strong>WhatsApp:</strong><br>
                    {{ $owner->whatsapp ?? '-' }}
                </div>

                <div>
                    <strong>Rekening BCA:</strong><br>
                    {{ $owner->rekening_bca ?? '-' }}
                </div>

                <div>
                    <strong>Rekening BNI:</strong><br>
                    {{ $owner->rekening_bni ?? '-' }}
                </div>

                <div>
                    <strong>DANA:</strong><br>
                    {{ $owner->dana ?? '-' }}
                </div>

                <div>
                    <strong>GoPay:</strong><br>
                    {{ $owner->gopay ?? '-' }}
                </div>

            </div>

        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Playstation
                </h4>

                <p class="text-4xl font-bold text-blue-600 mt-2">
                    {{ $jumlahPlaystation }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Booking
                </h4>

                <p class="text-4xl font-bold text-green-600 mt-2">
                    {{ $jumlahBooking }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h4 class="text-gray-500 text-sm uppercase">
                    Pendapatan
                </h4>

                <p class="text-3xl font-bold text-purple-600 mt-2">
                    Rp {{ number_format($pendapatan,0,',','.') }}
                </p>

            </div>

        </div>

    </div>

</div>

</x-app-layout>