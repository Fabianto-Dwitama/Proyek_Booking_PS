<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        🎮 Kelola Playstation
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))

            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>

        @endif

        <!-- Statistik -->

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            <div class="bg-white shadow rounded-lg p-6">

                <p class="text-gray-500">
                    Total Playstation
                </p>

                <h3 class="text-4xl font-bold text-blue-600 mt-2">
                    {{ $playstations->count() }}
                </h3>

            </div>

            <div class="bg-white shadow rounded-lg p-6">

                <p class="text-gray-500">
                    Tersedia
                </p>

                <h3 class="text-4xl font-bold text-green-600 mt-2">
                    {{ $playstations->where('status','tersedia')->count() }}
                </h3>

            </div>

            <div class="bg-white shadow rounded-lg p-6">

                <p class="text-gray-500">
                    Tidak Tersedia
                </p>

                <h3 class="text-4xl font-bold text-red-600 mt-2">
                    {{ $playstations->where('status','!=','tersedia')->count() }}
                </h3>

            </div>

        </div>

        <!-- Form Tambah -->

        <div class="bg-white shadow rounded-lg p-6 mb-6">

            <h3 class="text-xl font-bold mb-4">
                ➕ Tambah Playstation
            </h3>

            <form
                action="{{ route('playstations.store') }}"
                method="POST"
                class="grid md:grid-cols-4 gap-4"
            >
                @csrf

                <input
                    type="text"
                    name="nomor_ps"
                    placeholder="Nomor PS"
                    required
                    class="border rounded-lg px-3 py-2"
                >

                <input
                    type="text"
                    name="tipe_ps"
                    placeholder="PS4 / PS5"
                    required
                    class="border rounded-lg px-3 py-2"
                >

                <input
                    type="number"
                    name="harga_per_jam"
                    placeholder="Harga per jam"
                    required
                    class="border rounded-lg px-3 py-2"
                >

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-2"
                >
                    Simpan
                </button>

            </form>

        </div>

        <!-- Daftar PS -->

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($playstations as $ps)

                <div class="bg-white shadow rounded-lg p-6">

                    <div class="flex justify-between items-center mb-4">

                        <h3 class="text-xl font-bold">
                            {{ $ps->nomor_ps }}
                        </h3>

                        @if($ps->status == 'tersedia')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Tersedia
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Dipakai
                            </span>

                        @endif

                    </div>

                    <div class="space-y-2">

                        <p>
                            <strong>Tipe:</strong>
                            {{ $ps->tipe_ps }}
                        </p>

                        <p>
                            <strong>Harga:</strong>
                            Rp {{ number_format($ps->harga_per_jam,0,',','.') }}/jam
                        </p>

                    </div>

                    <div class="flex gap-2 mt-5">

                        <a
                            href="{{ route('playstations.edit', $ps->id) }}"
                            class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('playstations.destroy', $ps->id) }}"
                            method="POST"
                            class="flex-1"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus Playstation ini?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded"
                            >
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="col-span-3">

                    <div class="bg-white shadow rounded-lg p-8 text-center text-gray-500">

                        Belum ada Playstation.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

</x-app-layout>