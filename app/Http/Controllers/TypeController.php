<?php

namespace App\Http\Controllers;

use App\Type;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $query = Type::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('code', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('charge', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('summary', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $types = $query->paginate(10)->appends($request->all()); 
        return view('settings.types.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if (Type::where('code', $request->code)->where('deleted_at', NULL)->exists()) {
            Alert::error('Duplicate Entry', 'Code with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $type = new Type();
        $type->code = $request->code;
        $type->description = $request->description;
        $type->loan  = $request->loan;
        $type->charge = $request->charge;
        $type->summary = $request->summary;
        $type->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $data = Type::findOrFail($id);
        $data->code = $request->code;
        $data->description = $request->description;
        $data->loan = $request->loan;
        $data->charge = $request->charge;
        $data->summary = $request->summary;
        $data->save();
        
        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }
   
    public function destroy(Request $request)
    {
        $data = Type::findOrFail($request->id);
        $data->delete();

        Alert::success('Successfully Deleted')->persistent('Dismiss');
        return back();
    }
}