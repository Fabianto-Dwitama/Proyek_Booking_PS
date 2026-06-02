<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playstation;

class PlaystationController extends Controller
{
    public function index()
    {
        $playstations = Playstation::where(
            'owner_id',
            auth()->id()
        )->get();

        return view(
            'playstations.index',
            compact('playstations')
        );
    }

    public function create()
    {
        return view('playstations.create');
    }

    public function store(Request $request)
    {
        Playstation::create([
            'owner_id' => auth()->id(),
            'nomor_ps' => $request->nomor_ps,
            'tipe_ps' => $request->tipe_ps,
            'harga_per_jam' => $request->harga_per_jam,
            'status' => 'tersedia'
        ]);

        return redirect()
            ->route('playstations.index')
            ->with(
                'success',
                'Playstation berhasil ditambahkan'
            );
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $playstation = Playstation::where(
            'owner_id',
            auth()->id()
        )->findOrFail($id);

        return view(
            'playstations.edit',
            compact('playstation')
        );
    }

    public function update(Request $request, string $id)
    {
        $playstation = Playstation::where(
            'owner_id',
            auth()->id()
        )->findOrFail($id);

        $playstation->update([
            'nomor_ps' => $request->nomor_ps,
            'tipe_ps' => $request->tipe_ps,
            'harga_per_jam' => $request->harga_per_jam,
        ]);

        return redirect()
            ->route('playstations.index')
            ->with(
                'success',
                'Playstation berhasil diperbarui'
            );
    }

    public function destroy(string $id)
    {
        $playstation = Playstation::where(
            'owner_id',
            auth()->id()
        )->findOrFail($id);

        $playstation->delete();

        return redirect()
            ->route('playstations.index')
            ->with(
                'success',
                'Playstation berhasil dihapus'
            );
    }
}