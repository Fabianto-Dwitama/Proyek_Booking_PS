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
     * Public guest booking form (no login required)
     */
    public function createGuest()
    {
        $dbError = false;
        try {
            $playstations = Playstation::all();
        } catch (\Throwable $e) {
            // silent fail, inform view that DB is down
            \Log::error('BookingController::createGuest - Error: ' . $e->getMessage());
            $playstations = collect();
            $dbError = true;
        }

        return view('pembeli.bookings.guest_create', compact('playstations', 'dbError'));
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
     * Store booking from guest (no login required)
     */
    public function storeGuest(Request $request)
    {
        $request->validate([
            'playstation_id' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1',
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'nullable|string|max:50'
        ]);

        try {
            $playstation = Playstation::findOrFail($request->playstation_id);

            $total = $request->durasi * $playstation->harga_per_jam;

            $existing = Booking::where('playstation_id', $request->playstation_id)
                ->where('tanggal', $request->tanggal)
                ->where('jam_mulai', $request->jam_mulai)
                ->exists();

            if ($existing) {
                return back()->with('error', 'Jadwal sudah dibooking')->withInput();
            }
        } catch (\Throwable $e) {
            return back()->with('error', 'Tidak dapat memproses booking karena masalah koneksi database.')->withInput();
        }

        Booking::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'guest_name' => $request->guest_name,
            'guest_phone' => $request->guest_phone,
            'playstation_id' => $request->playstation_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
            'total_harga' => $total,
            'status' => 'pending'
        ]);

        return redirect()->route('booking.guest.create')
            ->with('success', 'Booking berhasil dibuat. Silakan tunggu konfirmasi dari admin.');
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
