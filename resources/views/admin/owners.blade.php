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

        <div class="bg-white shadow rounded overflow-hidden">

            <div class="p-4 border-b">

                <h3 class="text-lg font-bold">
                    Daftar Akun Owner
                </h3>

                <p class="text-gray-500 text-sm mt-1">
                    Total Owner: {{ $owners->count() }}
                </p>

            </div>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($owners as $owner)

                        <tr class="border-b">

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

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    {{ ucfirst($owner->role) }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center py-6 text-gray-500">
                                Tidak ada data owner
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>
