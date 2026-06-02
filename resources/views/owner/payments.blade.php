<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        💳 Verifikasi Pembayaran
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a
            href="/owner/dashboard"
            class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow"
        >
            ← Kembali ke Dashboard
        </a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">

            <div class="p-6 border-b">

                <h3 class="text-xl font-bold">
                    Daftar Pembayaran
                </h3>

                <p class="text-gray-500 text-sm mt-1">
                    Total Pembayaran: {{ $payments->count() }}
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                ID
                            </th>

                            <th class="px-4 py-3 text-left">
                                Pembeli
                            </th>

                            <th class="px-4 py-3 text-left">
                                Playstation
                            </th>

                            <th class="px-4 py-3 text-left">
                                Tanggal Booking
                            </th>

                            <th class="px-4 py-3 text-left">
                                Metode
                            </th>

                            <th class="px-4 py-3 text-left">
                                Nominal
                            </th>

                            <th class="px-4 py-3 text-left">
                                Status
                            </th>

                            <th class="px-4 py-3 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($payments as $payment)

                            <tr class="border-b hover:bg-gray-50">

                                <td class="px-4 py-3">
                                    #{{ $payment->id }}
                                </td>

                                <td class="px-4 py-3 font-medium">
                                    {{ $payment->booking->user->name ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $payment->booking->playstation->nomor_ps ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($payment->booking->tanggal)->format('d-m-Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $payment->metode }}
                                </td>

                                <td class="px-4 py-3 font-semibold text-green-600">
                                    Rp {{ number_format($payment->nominal, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3">

                                    @if($payment->status == 'pending')

                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                            Pending
                                        </span>

                                    @elseif($payment->status == 'verified')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Lunas
                                        </span>

                                    @else

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Ditolak
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-3">

                                    @if($payment->status == 'pending')

                                        <form
                                            action="/owner/payments/{{ $payment->id }}/verify"
                                            method="POST"
                                            class="inline"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg"
                                            >
                                                ✓ Verifikasi
                                            </button>

                                        </form>

                                    @else

                                        <span class="text-gray-500">
                                            Selesai
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-8 text-gray-500">
                                    Belum ada pembayaran
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</x-app-layout>