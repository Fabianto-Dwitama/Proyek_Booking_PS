@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-8">

<div class="bg-white shadow rounded-lg">

    <div class="border-b px-6 py-4">
        <h2 class="text-2xl font-bold">
            Buat Booking
        </h2>
    </div>

    <div class="p-6">

        <a
            href="{{ route('pembeli.dashboard') }}"
            class="inline-block mb-6 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
        >
            ← Kembali ke Dashboard
        </a>

        <form
            action="{{ route('pembeli.bookings.store') }}"
            method="POST"
            class="space-y-5"
        >
            @csrf

            <div>
                <label class="block mb-2 font-medium">
                    Playstation
                </label>

                <select
                    name="playstation_id"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                >
                    @foreach($playstations as $playstation)
                        <option value="{{ $playstation->id }}">
                            {{ $playstation->nomor_ps }}
                            -
                            {{ $playstation->tipe_ps }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                >
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Jam Mulai
                </label>

                <input
                    type="time"
                    name="jam_mulai"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                >
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Durasi (Jam)
                </label>

                <input
                    type="number"
                    name="durasi"
                    min="1"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                >
            </div>

            <button
                type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
            >
                Booking Sekarang
            </button>

        </form>

    </div>

</div>

</div>

@endsection
