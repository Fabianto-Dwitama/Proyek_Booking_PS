@extends('layouts.app')

@section('content')

<div class="min-h-screen" style="background: linear-gradient(180deg,#fffaf0 0%, #fff4e6 50%, #fff8f0 100%);">
    <div class="w-full max-w-6xl mx-auto px-6 py-10">

        <!-- Hero Header -->
        <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-3xl p-8 mb-10 border border-amber-200">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-amber-900 mb-2">
                        4PLAY PLAYSTATION - JAMBI
                    </h1>
                    <p class="text-lg text-amber-700">
                        Main Nyaman, Booking Mudah
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <button
                        onclick="openBooking()"
                        class="bg-amber-200 hover:bg-amber-300 text-amber-900 font-semibold px-6 py-3 rounded-lg shadow-md transition">
                        Booking Sekarang
                    </button>

                    <a href="/login"
                       class="bg-white border-2 border-amber-200 text-amber-900 font-semibold px-6 py-3 rounded-lg hover:bg-amber-50 transition">
                        Login
                    </a>
                </div>
            </div>
        </div>

        @if(isset($dbError) && $dbError)
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                Tidak dapat terhubung ke database. Data playstation mungkin tidak tersedia.
            </div>
        @endif

        <!-- Playstation List -->
        <div>
            <h2 class="text-2xl font-bold text-amber-900 mb-6">
                Playstation Tersedia
            </h2>

            @if($playstations->isEmpty())
                <div class="text-center py-10 text-gray-600">
                    <p>Tidak ada playstation yang tersedia saat ini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($playstations as $ps)
                        <div class="bg-white rounded-2xl border-2 border-amber-100 shadow-md hover:shadow-lg hover:border-amber-200 transition overflow-hidden">

                            <div class="bg-gradient-to-r from-amber-100 to-orange-100 p-4">
                                <h3 class="text-xl font-bold text-amber-900">
                                    {{ $ps->nomor_ps }}
                                </h3>

                                <p class="text-amber-700 text-sm">
                                    {{ $ps->tipe_ps }}
                                </p>
                            </div>

                            <div class="p-6">
                                <div class="mb-4">
                                    <p class="text-gray-600 text-sm">
                                        Harga Per Jam
                                    </p>

                                    <p class="text-3xl font-bold text-amber-600">
                                        Rp{{ number_format($ps->harga_per_jam ?? 0, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="mb-6">
                                    <span class="inline-block bg-green-100 text-green-800 font-semibold px-3 py-1 rounded-full text-sm">
                                        ✓ Tersedia
                                    </span>
                                </div>

                                <button
                                    onclick="openBookingForPS({{ $ps->id }})"
                                    class="w-full bg-amber-200 hover:bg-amber-300 text-amber-900 font-semibold py-2 rounded-lg transition">
                                    Booking
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <!-- Modal -->
    <div id="bookingModal"
         class="fixed inset-0 bg-black/40 flex items-center justify-center hidden z-50">

        <div id="bookingPanel"
             class="bg-white rounded-2xl w-full max-w-xl mx-4 p-6 shadow-lg transform transition-all duration-300 opacity-0 scale-95">

            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-amber-900">
                    Booking Playstation
                </h3>

                <button onclick="closeBooking()"
                        class="text-gray-500 text-2xl leading-none">
                    ×
                </button>
            </div>

            @if(session('error'))
                <div class="mb-3 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form id="guestBookingForm"
                  action="{{ route('booking.guest.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label class="block text-sm text-gray-600 font-semibold">
                        Nama Lengkap
                    </label>

                    <input
                        id="guest_name"
                        name="guest_name"
                        type="text"
                        value="{{ old('guest_name') }}"
                        required
                        class="mt-1 block w-full border border-amber-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300">

                    <p id="err_guest_name"
                       class="text-sm text-red-600 mt-1 hidden"></p>
                </div>

                <div class="mb-3">
                    <label class="block text-sm text-gray-600 font-semibold">
                        Nomor HP
                    </label>

                    <input
                        id="guest_phone"
                        name="guest_phone"
                        type="text"
                        value="{{ old('guest_phone') }}"
                        class="mt-1 block w-full border border-amber-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300">

                    <p id="err_guest_phone"
                       class="text-sm text-red-600 mt-1 hidden"></p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-sm text-gray-600 font-semibold">
                            Tanggal Booking
                        </label>

                        <input
                            name="tanggal"
                            type="date"
                            value="{{ old('tanggal') }}"
                            required
                            class="mt-1 block w-full border border-amber-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 font-semibold">
                            Jam Mulai
                        </label>

                        <input
                            name="jam_mulai"
                            type="time"
                            value="{{ old('jam_mulai') }}"
                            required
                            class="mt-1 block w-full border border-amber-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-sm text-gray-600 font-semibold">
                            Durasi (Jam)
                        </label>

                        <input
                            id="durasi"
                            name="durasi"
                            type="number"
                            value="{{ old('durasi', 1) }}"
                            min="1"
                            required
                            class="mt-1 block w-full border border-amber-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300">

                        <p id="err_durasi"
                           class="text-sm text-red-600 mt-1 hidden"></p>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 font-semibold">
                            Playstation
                        </label>

                        @if($playstations->isEmpty())
                            <select disabled
                                    class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
                                <option>Tidak ada PS</option>
                            </select>
                        @else
                            <select
                                id="playstation_id"
                                name="playstation_id"
                                required
                                class="mt-1 block w-full border border-amber-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300">

                                <option value="">
                                    Pilih Playstation
                                </option>

                                @foreach($playstations as $ps)
                                    <option value="{{ $ps->id }}">
                                        {{ $ps->nomor_ps }} - {{ $ps->tipe_ps }}
                                    </option>
                                @endforeach

                            </select>

                            <p id="err_playstation_id"
                               class="text-sm text-red-600 mt-1 hidden"></p>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                            onclick="closeBooking()"
                            class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 font-semibold transition">
                        Batal
                    </button>

                    <button
                        id="confirmBtn"
                        type="submit"
                        class="px-4 py-2 rounded bg-amber-200 hover:bg-amber-300 text-amber-900 font-semibold transition"
                        {{ $playstations->isEmpty() ? 'disabled' : '' }}>
                        Konfirmasi Booking
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<style>
    #bookingPanel.show{
        opacity:1 !important;
        transform:scale(1) !important;
    }
</style>

<script>

const bookingModal = document.getElementById('bookingModal');
const bookingPanel = document.getElementById('bookingPanel');
const form = document.getElementById('guestBookingForm');

function openBooking(selectedPs = null){

    const psSelect = document.getElementById('playstation_id');

    if(psSelect){
        if(selectedPs){
            psSelect.value = selectedPs;
        }else{
            psSelect.value = '';
        }
    }

    bookingModal.classList.remove('hidden');

    setTimeout(() => {
        bookingPanel.classList.add('show');
        bookingPanel.style.opacity = '1';
        bookingPanel.style.transform = 'scale(1)';
    }, 10);
}

function openBookingForPS(psId){
    openBooking(psId);
}

function closeBooking(){

    bookingPanel.classList.remove('show');
    bookingPanel.style.opacity = '0';
    bookingPanel.style.transform = 'scale(0.95)';

    setTimeout(() => {
        bookingModal.classList.add('hidden');
    }, 200);
}

document.addEventListener('keydown', function(e){
    if(e.key === 'Escape'){
        closeBooking();
    }
});

function showError(id, msg){

    const el = document.getElementById(id);

    if(!el) return;

    el.textContent = msg;
    el.classList.remove('hidden');
}

function clearError(id){

    const el = document.getElementById(id);

    if(!el) return;

    el.textContent = '';
    el.classList.add('hidden');
}

if(form){

    form.addEventListener('submit', function(e){

        [
            'err_guest_name',
            'err_guest_phone',
            'err_durasi',
            'err_playstation_id'
        ].forEach(clearError);

        let hasError = false;

        const name = document.getElementById('guest_name').value.trim();
        const durasi = document.getElementById('durasi').value;
        const playstationSelect = document.getElementById('playstation_id');

        if(!name){
            showError('err_guest_name', 'Nama lengkap wajib diisi');
            hasError = true;
        }

        if(
            durasi === '' ||
            isNaN(durasi) ||
            Number(durasi) < 1
        ){
            showError('err_durasi', 'Durasi minimal 1 jam');
            hasError = true;
        }

        if(
            playstationSelect &&
            !playstationSelect.value
        ){
            showError('err_playstation_id', 'Pilih playstation');
            hasError = true;
        }

        if(hasError){

            e.preventDefault();

            const firstErr = document.querySelector(
                '.text-red-600:not(.hidden)'
            );

            if(firstErr){
                firstErr.scrollIntoView({
                    behavior:'smooth',
                    block:'center'
                });
            }

            return false;
        }

        document.getElementById('confirmBtn').disabled = true;
    });
}

</script>

@endpush