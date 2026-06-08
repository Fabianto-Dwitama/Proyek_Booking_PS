<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
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

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Statistik -->

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

            <div class="bg-white shadow rounded-xl p-6">
                <p class="text-gray-500">Total Pembayaran</p>
                <h3 class="text-4xl font-bold text-blue-600 mt-2">
                    {{ $payments->count() }}
                </h3>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                <p class="text-gray-500">Pending</p>
                <h3 class="text-4xl font-bold text-yellow-500 mt-2">
                    {{ $payments->where('status','pending')->count() }}
                </h3>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                <p class="text-gray-500">Lunas</p>
                <h3 class="text-4xl font-bold text-green-600 mt-2">
                    {{ $payments->where('status','verified')->count() }}
                </h3>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                <p class="text-gray-500">Pendapatan</p>
                <h3 class="text-2xl font-bold text-green-700 mt-2">
                    Rp {{ number_format($payments->where('status','verified')->sum('nominal'),0,',','.') }}
                </h3>
            </div>

        </div>

        <!-- Tabel Pembayaran -->

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">

            <div class="p-6 border-b">
                <h3 class="text-xl font-bold">
                    Daftar Pembayaran
                </h3>

                <p class="text-gray-500 text-sm mt-1">
                    Semua transaksi pelanggan
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Pembeli</th>
                            <th class="px-4 py-3 text-left">Playstation</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Metode</th>
                            <th class="px-4 py-3 text-left">Bukti Transfer</th>
                            <th class="px-4 py-3 text-left">Nominal</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($payments as $payment)

                            <tr class="border-b hover:bg-gray-50">

                                <td class="px-4 py-3 font-semibold">
                                    #{{ $payment->id }}
                                </td>

                                <td class="px-4 py-3">

                                    <div class="font-medium">
                                        {{ $payment->booking->user->name ?? '-' }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $payment->booking->user->email ?? '-' }}
                                    </div>

                                </td>

                                <td class="px-4 py-3">

                                    <div class="font-medium">
                                        {{ $payment->booking->playstation->nomor_ps ?? '-' }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $payment->booking->playstation->tipe_ps ?? '-' }}
                                    </div>

                                </td>

                                <td class="px-4 py-3">

                                    @if($payment->booking)
                                        {{ \Carbon\Carbon::parse($payment->booking->tanggal)->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif

                                </td>

                                <td class="px-4 py-3">
                                    {{ $payment->metode }}
                                </td>

                                <td class="px-4 py-3">

                                    @if($payment->bukti_transfer)

                                        <a
                                            href="{{ asset('storage/'.$payment->bukti_transfer) }}"
                                            target="_blank"
                                        >
                                            <img
                                                src="{{ asset('storage/'.$payment->bukti_transfer) }}"
                                                class="w-20 h-20 object-cover rounded border"
                                                alt="Bukti Transfer"
                                            >
                                        </a>

                                    @else

                                        <span class="text-red-500">
                                            Belum Upload
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-3 font-semibold text-green-600">
                                    Rp {{ number_format($payment->nominal ?? 0,0,',','.') }}
                                </td>

                                <td class="px-4 py-3 text-center">

                                    @if($payment->status == 'pending')

                                        <div class="flex justify-center gap-2">

                                            <form
                                                action="/owner/payments/{{ $payment->id }}/verify"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Verifikasi pembayaran ini?')"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
                                                >
                                                    ✓ Verifikasi
                                                </button>

                                            </form>

                                            <form
                                                action="/owner/payments/{{ $payment->id }}/reject"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Tolak pembayaran ini?')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                                                >
                                                    ✖ Tolak
                                                </button>

                                            </form>

                                        </div>

                                    @elseif($payment->status == 'verified')

                                        <span class="text-green-600 font-semibold">
                                            ✔ Selesai
                                        </span>

                                    @else

                                        <span class="text-red-600 font-semibold">
                                            ✖ Ditolak
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center py-8 text-gray-500">
                                    Belum ada pembayaran.
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