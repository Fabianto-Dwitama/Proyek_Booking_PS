<h1>Daftar Playstation</h1>

<br>

<a
    href="/owner/dashboard"
    style="
        background:#6b7280;
        color:white;
        padding:8px 12px;
        text-decoration:none;
        border-radius:4px;
    "
>
    ← Kembali ke Dashboard
</a>

<br><br>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<h3>Tambah Playstation</h3>

<form action="{{ route('playstations.store') }}" method="POST">
    @csrf

    <input
        type="text"
        name="nomor_ps"
        placeholder="Nomor PS"
        required
    >

    <input
        type="text"
        name="tipe_ps"
        placeholder="Tipe PS"
        required
    >

    <input
        type="number"
        name="harga_per_jam"
        placeholder="Harga per Jam"
        required
    >

    <button type="submit">
        Tambah
    </button>
</form>

<br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nomor PS</th>
        <th>Tipe</th>
        <th>Harga/Jam</th>
        <th>Aksi</th>
    </tr>

    @foreach($playstations as $ps)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $ps->nomor_ps }}</td>
        <td>{{ $ps->tipe_ps }}</td>
        <td>Rp {{ number_format($ps->harga_per_jam) }}</td>

        <td>

            <a href="{{ route('playstations.edit', $ps->id) }}">
                Edit
            </a>

            |

            <form
                action="{{ route('playstations.destroy', $ps->id) }}"
                method="POST"
                style="display:inline;"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>
            </form>

        </td>
    </tr>
    @endforeach

</table>