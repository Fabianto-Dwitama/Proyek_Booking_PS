<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        📅 Data Booking
    </h2>
</x-slot>

<div class="py-6">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <a
        href="/owner/dashboard"
        class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg"
    >
        ← Kembali ke Dashboard
    </a>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

        <div class="p-6 border-b">

            <h3 class="text-xl font-bold">
                Daftar Booking
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Total Booking: {{ $bookings->count() }}
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
                            Tanggal
                        </th>

                        <th class="px-4 py-3 text-left">
                            Jam
                        </th>

                        <th class="px-4 py-3 text-left">
                            Durasi
                        </th>

                        <th class="px-4 py-3 text-left">
                            Total
                        </th>

                        <th class="px-4 py-3 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-4 py-3">
                                #{{ $booking->id }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $booking->user->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $booking->playstation->nomor_ps ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $booking->jam_mulai }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $booking->durasi }} Jam
                            </td>

                            <td class="px-4 py-3 font-semibold text-green-600">
                                Rp {{ number_format($booking->total_harga,0,',','.') }}
                            </td>

                            <td class="px-4 py-3">

                                @if($booking->status == 'pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Pending
                                    </span>

                                @elseif($booking->status == 'confirmed')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Dikonfirmasi
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-8 text-gray-500">
                                Belum ada booking
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
