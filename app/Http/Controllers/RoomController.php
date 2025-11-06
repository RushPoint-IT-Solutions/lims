<?php

namespace App\Http\Controllers;

use App\Room;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('floor', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $rooms = $query->paginate(10)->appends($request->all()); 
        return view('settings.rooms.index', compact('rooms'));
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (Room::where('name', $request->name)->whereNull('deleted_at')->exists()) {
            Alert::error('Duplicate Entry', 'Room with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $room = new Room();
        $room->name = $request->name;
        $room->floor = $request->floor;
        $room->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/rooms'), $filename);
            $room->image = 'uploads/rooms/' . $filename;
        }

        $room->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }


    public function update(Request $request, $id)
    {
        $data = Room::findOrFail($id);
        $data->name = $request->name;
        $data->floor = $request->floor;
        $data->description = $request->description;
        $data->save();
        
        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    public function destroy(Request $request)
    {
        $data = Room::findOrFail($request->id);
        $data->delete();

        Alert::success('Successfully Deleted')->persistent('Dismiss');
        return back();
    }
}