<?php

namespace App\Http\Controllers;

use App\Author;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Author::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $authors = $query->paginate(10)->appends($request->all()); 
        return view('authors.index', compact('authors'));
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Author::where('name', $request->name)->exists()) {
            Alert::error('Duplicate Entry', 'Author with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $author = new Author();
        $author->name = $request->name;
        $author->created_by = auth()->user()->id;
        $author->status = 'Active';
        $author->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        $data = Author::findOrFail($request->id);
        $data->status = 'Active';
        $data->save();

        Alert::success('Success', 'Successfully Activated!')->persistent('Dismiss');
        return back();
    }

    public function inactive(Request $request)
    {
        $data = Author::findOrFail($request->id);
        $data->status = 'Inactive';
        $data->save();

        Alert::success('Success', 'Successfully Inactive!')->persistent('Dismiss');
        return back();
    }
}
