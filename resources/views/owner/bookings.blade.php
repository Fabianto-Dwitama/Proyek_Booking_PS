<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        📅 Data Booking
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Tombol Kembali -->
        <a
            href="/owner/dashboard"
            class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
        >
            ← Kembali ke Dashboard
        </a>

        <!-- Card -->
        <div class="bg-white shadow rounded overflow-hidden">

            <div class="p-4 border-b">
                <h3 class="text-lg font-bold">
                    Daftar Booking Playstation
                </h3>
            </div>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Jam</th>
                        <th class="px-4 py-3 text-left">Durasi</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $booking->tanggal }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $booking->jam_mulai }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $booking->durasi }} Jam
                            </td>

                            <td class="px-4 py-3">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3">

                                @if($booking->status == 'pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Pending
                                    </span>

                                @elseif($booking->status == 'confirmed')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Confirmed
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Cancelled
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">
                                Belum ada data booking
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>
