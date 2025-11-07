<?php

namespace App\Http\Controllers;

use App\RoomReservation;
use App\Room;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;
use Illuminate\Http\Request;

class RoomReservationController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::get();
        $query = RoomReservation::query();
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $room_reservations_array = [];
        $room_reservations = RoomReservation::get();
        foreach($room_reservations as $room_reservation)
        {
            $object = new stdClass;
            $object->title = $room_reservation->room_name . "\n" . $room_reservation->purpose;
            $object->start = date('Y-m-d h:i:s', strtotime($room_reservation->reserved_from));
            $object->end = date('Y-m-d h:i:s', strtotime($room_reservation->reserved_to));
            switch (strtolower($room_reservation->purpose)) {
                case 'meeting':
                    $object->color = '#007bff'; 
                    break;
                case 'session':
                    $object->color = '#28a745'; 
                    break;
                case 'events':
                    $object->color = '#ffc107'; 
                    break;
                case 'other':
                    $object->color = '#dc3545'; 
                    break;
                default:
                    $object->color = '#6c757d'; 
                    break;
            }
            // $object->date_from = $leave_plan->date_from;
            // $object->date_to = $leave_plan->date_to;
            $room_reservations_array[] = $object;
        }

        $data = $query->paginate(10)->appends($request->all()); 
        return view('circulation.rooms_reservation.index', compact('data', 'rooms', 'room_reservations_array'));
    }    
    
    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'reserved_from' => 'required|date',
            'reserved_to' => 'required|date|after:reserved_from',
        ]);

        $year = date('Y');

        $lastReservation = RoomReservation::where('reservation_id', 'LIKE', 'RSV-%')
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastReservation && preg_match('/RSV-\d{2}-00(\d+)/', $lastReservation->reservation_id, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        }

        $reservationId = sprintf("RSV-%s-00%d", $year, $nextNumber);

        $data = new RoomReservation();
        $data->reservation_id = $reservationId;
        $data->room_name = $request->room_name;
        $data->reserved_by = auth()->user()->id;
        $data->reserved_from = $request->reserved_from;
        $data->reserved_to = $request->reserved_to;
        $data->purpose = $request->purpose;
        $data->other_remarks = $request->purpose === 'Other' ? $request->other_remarks : null;
        $data->status = 'Pending';
        $data->save();

        Alert::success('Success', 'Room reservation successfully saved!')->persistent('Dismiss');
        return back();
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
