<x-guest-layout>

<div class="w-full max-w-md mx-auto">

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Verifikasi Email
        </h1>

        <p class="text-gray-500 mt-2">
            Satu langkah lagi sebelum menggunakan aplikasi.
        </p>

    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8">

        <div class="text-sm text-gray-600 leading-relaxed">

            Terima kasih telah mendaftar.

            Sebelum mulai menggunakan sistem Booking Rental Playstation,
            silakan verifikasi alamat email Anda melalui link yang telah
            kami kirimkan ke email terdaftar.

            Jika email belum diterima, Anda dapat mengirim ulang link verifikasi.

        </div>

        @if (session('status') == 'verification-link-sent')

            <div
                class="mt-4 p-4 rounded-lg bg-green-100 text-green-700 text-sm"
            >
                Link verifikasi baru berhasil dikirim ke email Anda.
            </div>

        @endif

        <div class="mt-6 flex flex-col gap-3">

            <form
                method="POST"
                action="{{ route('verification.send') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition"
                >
                    Kirim Ulang Email Verifikasi
                </button>

            </form>

            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-3 rounded-lg transition"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>