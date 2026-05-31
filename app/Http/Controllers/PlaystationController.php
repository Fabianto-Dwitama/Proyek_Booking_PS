<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playstation;

class PlaystationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playstations = Playstation::all();

        return view('playstations.index', compact('playstations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('playstations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Playstation::create([
        'nomor_ps' => $request->nomor_ps,
        'tipe_ps' => $request->tipe_ps,
        'harga_per_jam' => $request->harga_per_jam,
        'status' => 'tersedia'
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $playstation = Playstation::findOrFail($id);

        return view(
            'playstations.edit',
            compact('playstation')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $playstation = Playstation::findOrFail($id);

        $playstation->update([
            'nomor_ps' => $request->nomor_ps,
            'tipe_ps' => $request->tipe_ps,
            'harga_per_jam' => $request->harga_per_jam,
        ]);

        return redirect()
            ->route('playstations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Playstation::destroy($id);

        return redirect()
            ->route('playstations.index');
    }
}
