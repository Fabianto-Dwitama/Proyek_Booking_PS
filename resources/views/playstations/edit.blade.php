<h1>Edit Playstation</h1>

<form
    action="{{ route('playstations.update', $playstation->id) }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <label>Nomor PS</label>
    <input
        type="text"
        name="nomor_ps"
        value="{{ $playstation->nomor_ps }}"
    >

    <br><br>

    <label>Tipe PS</label>
    <input
        type="text"
        name="tipe_ps"
        value="{{ $playstation->tipe_ps }}"
    >

    <br><br>

    <label>Harga per Jam</label>
    <input
        type="number"
        name="harga_per_jam"
        value="{{ $playstation->harga_per_jam }}"
    >

    <br><br>

    <button type="submit">
        Update
    </button>
</form>