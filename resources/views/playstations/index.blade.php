@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-8">

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Kelola Playstation
        </h1>

        <p class="text-gray-500 mt-1">
            Manajemen unit Playstation rental
        </p>

    </div>

</div>

@if(session('success'))

    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>

@endif

<div class="bg-white rounded-xl shadow p-6 mb-8">

    <h2 class="text-xl font-semibold mb-4">
        Tambah Playstation
    </h2>

    <form
        action="{{ route('owner.playstations.store') }}"
        method="POST"
        class="grid md:grid-cols-4 gap-4"
    >

        @csrf

        <input
            type="text"
            name="nomor_ps"
            placeholder="Nomor PS"
            class="border rounded-lg px-4 py-2"
            required
        >

        <input
            type="text"
            name="tipe_ps"
            placeholder="Tipe PS"
            class="border rounded-lg px-4 py-2"
            required
        >

        <input
            type="number"
            name="harga_per_jam"
            placeholder="Harga per Jam"
            class="border rounded-lg px-4 py-2"
            required
        >

        <button
            type="submit"
            class="bg-indigo-600 text-white rounded-lg px-4 py-2 hover:bg-indigo-700"
        >
            Tambah
        </button>

    </form>

</div>

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-gray-50">

            <tr>

                <th class="px-6 py-3 text-left">
                    No
                </th>

                <th class="px-6 py-3 text-left">
                    Nomor PS
                </th>

                <th class="px-6 py-3 text-left">
                    Tipe
                </th>

                <th class="px-6 py-3 text-left">
                    Harga/Jam
                </th>

                <th class="px-6 py-3 text-left">
                    Status
                </th>

                <th class="px-6 py-3 text-left">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody class="divide-y">

            @forelse($playstations as $ps)

            <tr>

                <td class="px-6 py-4">
                    {{ $loop->iteration }}
                </td>

                <td class="px-6 py-4">
                    {{ $ps->nomor_ps }}
                </td>

                <td class="px-6 py-4">
                    {{ $ps->tipe_ps }}
                </td>

                <td class="px-6 py-4">
                    Rp {{ number_format($ps->harga_per_jam,0,',','.') }}
                </td>

                <td class="px-6 py-4">

                    @if($ps->status === 'tersedia')

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                            Tersedia
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                            Maintenance
                        </span>

                    @endif

                </td>

                <td class="px-6 py-4 flex gap-3">

                    <a
                        href="{{ route('owner.playstations.edit',$ps->id) }}"
                        class="px-3 py-2 bg-yellow-500 text-white rounded-lg"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('owner.playstations.destroy',$ps->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="px-3 py-2 bg-red-600 text-white rounded-lg"
                            onclick="return confirm('Hapus Playstation?')"
                        >
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center py-8 text-gray-500">
                    Belum ada data Playstation
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

</div>

@endsection
