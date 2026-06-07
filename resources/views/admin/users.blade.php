<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        👥 Kelola User
    </h2>
</x-slot>

<div class="py-6">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl shadow-lg p-6 mb-6">

        <h1 class="text-3xl font-bold">
            Data User Pembeli
        </h1>

        <p class="mt-2 text-blue-100">
            Kelola seluruh akun pembeli yang terdaftar pada sistem rental Playstation.
        </p>

    </div>

    <!-- Tombol Kembali -->

    <a
        href="/admin/dashboard"
        class="inline-flex items-center gap-2 mb-6 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow"
    >
        ← Kembali ke Dashboard
    </a>

    <!-- Alert -->

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistik -->

    <div class="grid md:grid-cols-3 gap-6 mb-6">

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500 text-sm uppercase">
                Total User
            </p>

            <h3 class="text-4xl font-bold text-blue-600 mt-2">
                {{ $users->count() }}
            </h3>

        </div>

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500 text-sm uppercase">
                User Aktif
            </p>

            <h3 class="text-4xl font-bold text-green-600 mt-2">
                {{ $users->count() }}
            </h3>

        </div>

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500 text-sm uppercase">
                Role
            </p>

            <h3 class="text-2xl font-bold text-purple-600 mt-2">
                Pembeli
            </h3>

        </div>

    </div>

    <!-- Tabel User -->

    <div class="bg-white shadow-xl rounded-xl overflow-hidden">

        <div class="p-6 border-b">

            <h3 class="text-xl font-bold">
                Daftar User Pembeli
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Menampilkan seluruh akun pembeli yang terdaftar.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Nama
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Role
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="px-6 py-4">
                                #{{ $user->id }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ ucfirst($user->role) }}
                                </span>

                            </td>

                            <td class="px-6 py-4 text-center">

                                <form
                                    action="/admin/users/{{ $user->id }}"
                                    method="POST"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow"
                                    >
                                        🗑 Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-12 text-gray-500">

                                <div class="flex flex-col items-center">

                                    <span class="text-5xl mb-3">
                                        👤
                                    </span>

                                    <p>
                                        Belum ada user terdaftar
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

</x-app-layout>
