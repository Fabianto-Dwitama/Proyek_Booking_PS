<a
    href="/pembeli/dashboard"
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

<h1>Buat Booking</h1>

@if($errors->any())

    <div style="color:red">

        @foreach($errors->all() as $error)

            <p>{{ $error }}</p>

        @endforeach

    </div>

@endif

<form action="{{ route('bookings.store') }}" method="POST">
    @csrf

    <label>Playstation</label>

    <select name="playstation_id">

        @foreach($playstations as $ps)

            <option value="{{ $ps->id }}">
                {{ $ps->nomor_ps }}
                -
                {{ $ps->tipe_ps }}
            </option>

        @endforeach

    </select>

    <br><br>

    <label>Tanggal</label>

    <input
        type="date"
        name="tanggal"
    >

    <br><br>

    <label>Jam Mulai</label>

    <input
        type="time"
        name="jam_mulai"
    >

    <br><br>

    <label>Durasi (Jam)</label>

    <input
        type="number"
        name="durasi"
    >

    <br><br>

    <button type="submit">
        Booking
    </button>

</form>