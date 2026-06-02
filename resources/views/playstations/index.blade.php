<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        🎮 Kelola Playstation
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

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah PS -->
        <div class="bg-white shadow rounded p-6 mb-6">

            <h3 class="text-lg font-bold mb-4">
                Tambah Playstation
            </h3>

            <form
                action="{{ route('playstations.store') }}"
                method="POST"
                class="grid grid-cols-1 md:grid-cols-4 gap-4"
            >
                @csrf

                <input
                    type="text"
                    name="nomor_ps"
                    placeholder="Nomor PS"
                    required
                    class="border rounded px-3 py-2"
                >

                <input
                    type="text"
                    name="tipe_ps"
                    placeholder="Tipe PS"
                    required
                    class="border rounded px-3 py-2"
                >

                <input
                    type="number"
                    name="harga_per_jam"
                    placeholder="Harga per Jam"
                    required
                    class="border rounded px-3 py-2"
                >

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded px-4 py-2"
                >
                    Tambah
                </button>

            </form>

        </div>

        <!-- Tabel Playstation -->
        <div class="bg-white shadow rounded overflow-hidden">

            <div class="p-4 border-b">
                <h3 class="text-lg font-bold">
                    Daftar Playstation
                </h3>
            </div>

            <table class="min-w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nomor PS</th>
                        <th class="px-4 py-3 text-left">Tipe</th>
                        <th class="px-4 py-3 text-left">Harga/Jam</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($playstations as $ps)

                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $ps->nomor_ps }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $ps->tipe_ps }}
                            </td>

                            <td class="px-4 py-3">
                                Rp {{ number_format($ps->harga_per_jam, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-center">

                                <a
                                    href="{{ route('playstations.edit', $ps->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('playstations.destroy', $ps->id) }}"
                                    method="POST"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus Playstation ini?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                                    >
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">
                                Belum ada data Playstation
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

</x-app-layout>
