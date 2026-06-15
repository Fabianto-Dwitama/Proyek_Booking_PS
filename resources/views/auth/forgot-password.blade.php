<x-guest-layout>

<div class="w-full max-w-md mx-auto">

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Lupa Password
        </h1>

        <p class="text-gray-500 mt-2">
            Masukkan email akun Anda untuk menerima link reset password.
        </p>

    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8">

        <x-auth-session-status
            class="mb-4"
            :status="session('status')"
        />

        <form
            method="POST"
            action="{{ route('password.email') }}"
            class="space-y-5"
        >
            @csrf

            <div>

                <x-input-label
                    for="email"
                    :value="__('Email')"
                />

                <x-text-input
                    id="email"
                    class="block mt-2 w-full rounded-lg"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />

            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition"
            >
                Kirim Link Reset Password
            </button>

            <div class="text-center">

                <a
                    href="{{ route('login') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-800"
                >
                    Kembali ke Login
                </a>

            </div>

        </form>

    </div>

</div>

</x-guest-layout>