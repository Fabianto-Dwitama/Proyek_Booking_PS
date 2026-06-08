<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Playstation;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where(
            'user_id',
            auth()->id()
        )->get();

        return view(
            'pembeli.bookings.index',
            compact('bookings')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $playstations = Playstation::all();

        return view(
            'pembeli.bookings.create',
            compact('playstations')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'playstation_id' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1'
        ]);   
    
        $playstation = Playstation::findOrFail($request->playstation_id);

        $total = $request->durasi * $playstation->harga_per_jam;

        $existing = Booking::where('playstation_id', $request->playstation_id)
        ->where('tanggal', $request->tanggal)
        ->where('jam_mulai', $request->jam_mulai)
        ->exists();

        if($existing){
            return back()->with('error', 'Jadwal sudah dibooking');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'playstation_id' => $request->playstation_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
            'total_harga' => $total,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Booking berhasil dibuat'
            );
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
