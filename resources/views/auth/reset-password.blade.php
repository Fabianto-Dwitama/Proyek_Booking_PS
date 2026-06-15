<x-guest-layout>

<div class="w-full max-w-md mx-auto">

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Reset Password
        </h1>

        <p class="text-gray-500 mt-2">
            Buat password baru untuk akun Anda.
        </p>

    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8">

        <form
            method="POST"
            action="{{ route('password.store') }}"
            class="space-y-5"
        >
            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $request->route('token') }}"
            >

            <!-- Email -->

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
                    :value="old('email', $request->email)"
                    required
                    autofocus
                />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />

            </div>

            <!-- Password Baru -->

            <div>

                <x-input-label
                    for="password"
                    :value="__('Password Baru')"
                />

                <x-text-input
                    id="password"
                    class="block mt-2 w-full rounded-lg"
                    type="password"
                    name="password"
                    required
                />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />

            </div>

            <!-- Konfirmasi Password -->

            <div>

                <x-input-label
                    for="password_confirmation"
                    :value="__('Konfirmasi Password')"
                />

                <x-text-input
                    id="password_confirmation"
                    class="block mt-2 w-full rounded-lg"
                    type="password"
                    name="password_confirmation"
                    required
                />

                <x-input-error
                    :messages="$errors->get('password_confirmation')"
                    class="mt-2"
                />

            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition"
            >
                Simpan Password Baru
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