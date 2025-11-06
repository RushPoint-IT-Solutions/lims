<?php

namespace App\Http\Controllers;

use App\RoomReservation;
use Illuminate\Http\Request;

class RoomReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = RoomReservation::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $data = $query->paginate(10)->appends($request->all()); 
        return view('circulation.rooms_reservation.index', compact('data'));
    }    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomReservation  $roomReservation
     * @return \Illuminate\Http\Response
     */
    public function show(RoomReservation $roomReservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomReservation  $roomReservation
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomReservation $roomReservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomReservation  $roomReservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomReservation $roomReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomReservation  $roomReservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomReservation $roomReservation)
    {
        //
    }
}
