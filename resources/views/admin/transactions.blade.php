<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        💳 Laporan Transaksi
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a
            href="/admin/dashboard"
            class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
        >
            ← Kembali ke Dashboard
        </a>

        <div class="bg-white shadow rounded overflow-hidden">

            <div class="p-4 border-b">

                <h3 class="text-lg font-bold">
                    Riwayat Transaksi
                </h3>

                <p class="text-gray-500 text-sm mt-1">
                    Total Transaksi: {{ $payments->count() }}
                </p>

            </div>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Booking ID</th>
                        <th class="px-4 py-3 text-left">Metode</th>
                        <th class="px-4 py-3 text-left">Nominal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($payments as $payment)

                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $payment->id }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $payment->booking_id }}
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
                                        Verified
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Rejected
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3">
                                {{ $payment->created_at->format('d-m-Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-6 text-gray-500">
                                Belum ada transaksi
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>