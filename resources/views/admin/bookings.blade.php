<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        📅 Data Booking
    </h2>
</x-slot>

<div class="py-6">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Header -->

    <div class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-xl shadow-lg p-6 mb-6">

        <h1 class="text-3xl font-bold">
            Monitoring Booking
        </h1>

        <p class="mt-2 text-yellow-100">
            Pantau seluruh aktivitas booking Playstation dari pelanggan.
        </p>

    </div>

    <!-- Tombol Kembali -->

    <a
        href="/admin/dashboard"
        class="inline-flex items-center gap-2 mb-6 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow"
    >
        ← Kembali ke Dashboard
    </a>

    <!-- Alert -->

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistik -->

    <div class="grid md:grid-cols-3 gap-6 mb-6">

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500 text-sm uppercase">
                Total Booking
            </p>

            <h3 class="text-4xl font-bold text-blue-600 mt-2">
                {{ $bookings->count() }}
            </h3>

        </div>

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500 text-sm uppercase">
                Booking Pending
            </p>

            <h3 class="text-4xl font-bold text-yellow-500 mt-2">
                {{ $bookings->where('status','pending')->count() }}
            </h3>

        </div>

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500 text-sm uppercase">
                Booking Confirmed
            </p>

            <h3 class="text-4xl font-bold text-green-600 mt-2">
                {{ $bookings->where('status','confirmed')->count() }}
            </h3>

        </div>

    </div>

    <!-- Tabel -->

    <div class="bg-white shadow-xl rounded-xl overflow-hidden">

        <div class="p-6 border-b">

            <h3 class="text-xl font-bold">
                Daftar Booking
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Menampilkan seluruh data booking pelanggan.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left">
                            Pembeli
                        </th>

                        <th class="px-6 py-4 text-left">
                            Playstation
                        </th>

                        <th class="px-6 py-4 text-left">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left">
                            Jam
                        </th>

                        <th class="px-6 py-4 text-left">
                            Durasi
                        </th>

                        <th class="px-6 py-4 text-left">
                            Total
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                #{{ $booking->id }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $booking->user->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $booking->playstation->nomor_ps ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $booking->tanggal }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $booking->jam_mulai }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $booking->durasi }} Jam
                            </td>

                            <td class="px-6 py-4 font-semibold text-green-600">
                                Rp {{ number_format($booking->total_harga,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">

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

                            <td class="px-6 py-4 text-center">

                                <form
                                    action="/admin/bookings/{{ $booking->id }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus booking ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                                    >
                                        🗑 Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-12 text-gray-500">

                                <div class="flex flex-col items-center">

                                    <span class="text-5xl mb-3">
                                        📅
                                    </span>

                                    <p>
                                        Belum ada data booking
                                    </p>

                                </div>

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
