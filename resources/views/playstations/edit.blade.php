@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-8">

    <div class="mb-6">

        <h1 class="text-3xl font-bold text-gray-800">
            Edit Playstation
        </h1>

        <p class="text-gray-500 mt-2">
            Perbarui informasi Playstation
        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <form
            action="{{ route('owner.playstations.update', $playstation->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="mb-5">

                <label class="block mb-2 font-medium">
                    Nomor PS
                </label>

                <input
                    type="text"
                    name="nomor_ps"
                    value="{{ old('nomor_ps', $playstation->nomor_ps) }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-medium">
                    Tipe PS
                </label>

                <input
                    type="text"
                    name="tipe_ps"
                    value="{{ old('tipe_ps', $playstation->tipe_ps) }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-medium">
                    Harga per Jam
                </label>

                <input
                    type="number"
                    name="harga_per_jam"
                    value="{{ old('harga_per_jam', $playstation->harga_per_jam) }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-medium">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-2"
                >

                    <option
                        value="tersedia"
                        {{ $playstation->status == 'tersedia' ? 'selected' : '' }}
                    >
                        Tersedia
                    </option>

                    <option
                        value="digunakan"
                        {{ $playstation->status == 'digunakan' ? 'selected' : '' }}
                    >
                        Digunakan
                    </option>

                    <option
                        value="maintenance"
                        {{ $playstation->status == 'maintenance' ? 'selected' : '' }}
                    >
                        Maintenance
                    </option>

                </select>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                >
                    Update
                </button>

                <a
                    href="{{ route('owner.playstations.index') }}"
                    class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection