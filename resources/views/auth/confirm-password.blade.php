<x-guest-layout>

<div class="w-full max-w-md mx-auto">

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Konfirmasi Password
        </h1>

        <p class="text-gray-500 mt-2">
            Demi keamanan akun, silakan masukkan password Anda untuk melanjutkan.
        </p>

    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8">

        <form
            method="POST"
            action="{{ route('password.confirm') }}"
            class="space-y-5"
        >
            @csrf

            <div>

                <x-input-label
                    for="password"
                    :value="__('Password')"
                />

                <x-text-input
                    id="password"
                    class="block mt-2 w-full rounded-lg"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />

            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition"
            >
                Konfirmasi Password
            </button>

        </form>

    </div>

</div>

</x-guest-layout>