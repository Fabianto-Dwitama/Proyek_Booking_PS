<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        👥 Kelola User
    </h2>
</x-slot>

<div class="py-6">

```
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

    <div class="bg-white shadow rounded overflow-hidden">

        <div class="p-4 border-b">

            <h3 class="text-lg font-bold">
                Daftar User Pembeli
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Total User: {{ $users->count() }}
            </p>

        </div>

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Role</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr class="border-b">

                        <td class="px-4 py-3">
                            {{ $user->id }}
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $user->name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $user->email }}
                        </td>

                        <td class="px-4 py-3">

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                {{ ucfirst($user->role) }}
                            </span>

                        </td>

                        <td class="px-4 py-3 text-center">

                            <form
                                action="/admin/users/{{ $user->id }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menghapus user ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Tidak ada data user
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
```

</div>

</x-app-layout>
