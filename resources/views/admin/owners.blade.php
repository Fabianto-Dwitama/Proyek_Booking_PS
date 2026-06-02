<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        🏢 Kelola Owner
    </h2>
</x-slot>

<div class="py-6">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a
            href="/admin/dashboard"
            class="inline-block mb-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
        >
            ← Kembali ke Dashboard
        </a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah Owner -->
        <div class="bg-white shadow rounded p-6 mb-6">

            <h3 class="text-lg font-bold mb-4">
                ➕ Tambah Owner
            </h3>

            <form action="/admin/owners" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input
                        type="text"
                        name="name"
                        placeholder="Nama Owner"
                        required
                        class="border rounded px-3 py-2"
                    >

                    <input
                        type="email"
                        name="email"
                        placeholder="Email Owner"
                        required
                        class="border rounded px-3 py-2"
                    >

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="border rounded px-3 py-2"
                    >

                </div>

                <button
                    type="submit"
                    class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
                >
                    Tambah Owner
                </button>

            </form>

        </div>

        <!-- Data Owner -->
        <div class="bg-white shadow rounded overflow-hidden">

            <div class="p-4 border-b">

                <h3 class="text-lg font-bold">
                    Daftar Akun Owner
                </h3>

                <p class="text-gray-500 text-sm mt-1">
                    Total Owner: {{ $owners->count() }}
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">WhatsApp</th>
                            <th class="px-4 py-3 text-left">BCA</th>
                            <th class="px-4 py-3 text-left">BNI</th>
                            <th class="px-4 py-3 text-left">DANA</th>
                            <th class="px-4 py-3 text-left">GoPay</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($owners as $owner)

                            <tr class="border-b hover:bg-gray-50">

                                <td class="px-4 py-3">
                                    {{ $owner->id }}
                                </td>

                                <td class="px-4 py-3 font-medium">
                                    {{ $owner->name }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $owner->email }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $owner->whatsapp ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $owner->rekening_bca ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $owner->rekening_bni ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $owner->dana ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $owner->gopay ?? '-' }}
                                </td>

                                <td class="px-4 py-3">

                                    @if(
                                        $owner->whatsapp &&
                                        (
                                            $owner->rekening_bca ||
                                            $owner->rekening_bni ||
                                            $owner->dana ||
                                            $owner->gopay
                                        )
                                    )

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Lengkap
                                        </span>

                                    @else

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Belum Lengkap
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-3 text-center">

                                    <form
                                        action="/admin/owners/{{ $owner->id }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Yakin ingin menghapus owner ini?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="10" class="text-center py-6 text-gray-500">
                                    Tidak ada data owner
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