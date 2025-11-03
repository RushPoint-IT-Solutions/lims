<?php

namespace App\Http\Controllers;

use App\Branch;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $query = Branch::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('branch_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('contact_no', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('location', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('contact_person', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('address', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $branches = $query->paginate(10)->appends($request->all()); 
        return view('settings.branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        if (Branch::where('branch_name', $request->branch_name)->where('deleted_at', NULL)->exists()) {
            Alert::error('Duplicate Entry', 'Branch with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $branch = new Branch();
        $branch->branch_name = $request->branch_name;
        $branch->contact_no = $request->contact_no;
        $branch->location = $request->location;
        $branch->contact_person = $request->contact_person;
        $branch->address = $request->address;
        $branch->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    public function update(Request $request, $id)
    {
        $data = Branch::findOrFail($id);
        $data->branch_name = $request->branch_name;
        $data->contact_no = $request->contact_no;
        $data->location = $request->location;
        $data->contact_person = $request->contact_person;
        $data->address = $request->address;
        $data->save();
        
        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    public function destroy(Request $request)
    {
        $data = Branch::findOrFail($request->id);
        $data->delete();

        Alert::success('Successfully Deleted')->persistent('Dismiss');
        return back();
    }
}
