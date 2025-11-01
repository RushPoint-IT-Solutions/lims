<?php

namespace App\Http\Controllers;

use App\Rack;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function index(Request $request)
    {
        $query = Rack::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $racks = $query->paginate(10)->appends($request->all()); 
        return view('racks.index', compact('racks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Rack::where('name', $request->name)->exists()) {
            Alert::error('Duplicate Entry', 'Rack with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $author = new Rack();
        $author->name = $request->name;
        $author->created_by = auth()->user()->id;
        $author->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();

    }

    public function update(Request $request, $id)
    {
        $data = Rack::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

}
