<?php

namespace App\Http\Controllers;

use App\Framework;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class FrameworkController extends Controller
{
    public function index(Request $request)
    {
        $query = Framework::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('code', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $frameworks = $query->paginate(10)->appends($request->all()); 
        return view('frameworks.index', compact('frameworks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if (Framework::where('code', $request->code)->where('deleted_at', NULL)->exists()) {
            Alert::error('Duplicate Entry', 'Code with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $data = new Framework();
        $data->code = $request->code;
        $data->description = $request->description;
        $data->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    public function update(Request $request, $id)
    {
        $data = Framework::findOrFail($id);
        $data->description = $request->description;
        $data->save();
        
        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    public function destroy(Request $request)
    {
        $data = Framework::findOrFail($request->id);
        $data->delete();

        Alert::success('Successfully Deleted')->persistent('Dismiss');
        return back();
    }
}
