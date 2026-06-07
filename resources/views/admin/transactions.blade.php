<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        💳 Laporan Transaksi
    </h2>
</x-slot>

<div class="py-6">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <a
        href="/admin/dashboard"
        class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg"
    >
        ← Kembali ke Dashboard
    </a>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-6 border-b">

            <h3 class="text-xl font-bold">
                Riwayat Pembayaran
            </h3>

            <p class="text-gray-500 text-sm">
                Total Transaksi : {{ $payments->count() }}
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
                            Booking
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
                            Tanggal
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
                                #{{ $payment->booking_id }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $payment->metode }}
                            </td>

                            <td class="px-4 py-3 font-bold text-green-600">
                                Rp {{ number_format($payment->nominal,0,',','.') }}
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
                                {{ $payment->created_at->format('d-m-Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-8 text-gray-500">
                                Belum ada transaksi
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
