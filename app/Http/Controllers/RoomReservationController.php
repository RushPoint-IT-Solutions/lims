<?php

namespace App\Http\Controllers;

use App\RoomReservation;
use App\Room;
use stdClass;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class RoomReservationController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $rooms = Room::all();

        $query = RoomReservation::query();
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $reservedRoomNames = RoomReservation::where('status', 'Approved')
            ->whereDate('reserved_from', '<=', $today)
            ->whereDate('reserved_to', '=', $today)
            ->pluck('room_name')
            ->unique();

        $availableRooms = Room::whereNotIn('name', $reservedRoomNames)->get();
        
        $room_reservations_array = [];
        $room_reservations = RoomReservation::where('status', 'Approved')->get();

        foreach ($room_reservations as $room_reservation) {
            $object = new stdClass;
            $object->title  = $room_reservation->room_name;
            $object->start  = date('Y-m-d H:i:s', strtotime($room_reservation->reserved_from));
            $object->end    = date('Y-m-d H:i:s', strtotime($room_reservation->reserved_to));
           
            $object->id     = $room_reservation->id;
            $object->reason = $room_reservation->purpose;
            switch (strtolower($room_reservation->purpose)) {
                case 'meeting':
                    $object->color = '#007bff';
                    break;
                case 'session':
                    $object->color = '#28a745';
                    break;
                case 'events':
                    $object->color = '#ffc107';
                    $object->textColor = '#000'; 
                    break;
                case 'other':
                    $object->color = '#dc3545';
                    break;
                default:
                    $object->color = '#6c757d';
                    break;
            }

            $room_reservations_array[] = $object;
        }


        $datas = $query->paginate(10)->appends($request->all()); 
        return view('circulation.rooms_reservation.index', compact('datas', 'rooms', 'room_reservations_array', 'availableRooms'));
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

        $lastReservation = RoomReservation::where('reservation_id', 'LIKE', "RSV-$year-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastReservation) {
            preg_match('/RSV-\d{4}-00(\d+)/', $lastReservation->reservation_id, $matches);
            $nextNumber = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        } else {
            $nextNumber = 1;
        }

        $reservationId = sprintf("RSV-%s-%03d", $year, $nextNumber);

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
    
    public function approved(Request $request)
    {
        $data = RoomReservation::findOrFail($request->id);        
        $data->status = 'Approved';
        $data->approved_by = auth()->user()->id;
        $data->approved_date = Carbon::now();
        $data->save();

        Alert::success('Successfully Approved')->persistent('Dismiss');
        return back();
    }

    public function disapproved(Request $request, $id)
    {
        $data = RoomReservation::findOrFail($id);
        $data->status = 'Disapproved';
        $data->disapproved_by = auth()->user()->id;
        $data->disapproved_date = Carbon::now();
        $data->remarks = $request->remarks; 
        $data->save();
        
        Alert::success('Successfully Disapproved!')->persistent('Dismiss');
        return back();
    }

    public function destroy(Request $request)
    {
        $data = RoomReservation::findOrFail($request->id);
        $data->delete();

        Alert::success('Successfully Deleted')->persistent('Dismiss');
        return back();
    }
}
