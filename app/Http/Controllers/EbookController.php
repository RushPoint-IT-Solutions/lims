<?php

namespace App\Http\Controllers;

use App\Ebook;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    public function index(Request $request)
    {
        $query = Ebook::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('code', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $ebooks = $query->paginate(10)->appends($request->all()); 
        return view('digital.ebooks.index', compact('ebooks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
        ]);

        if (Ebook::where('isbn', $request->isbn)->where('deleted_at', NULL)->exists()) {
            Alert::error('Duplicate Entry', 'ISBN with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $data = new Ebook();
        $data->book_title = $request->book_title;
        $data->author_name = $request->author_name;
        $data->isbn = $request->isbn;
        $data->publisher = $request->publisher;
        $data->publication_year = $request->publication_year;
        $data->page_count = $request->page_count;
        if ($request->hasFile('cover_image_path')) {
            $file = $request->file('cover_image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ebooks'), $filename);
            $room->cover_image_path = 'uploads/ebooks/' . $filename;
        }
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ebooks_pdf'), $filename);
            $room->file_path = 'uploads/ebooks_pdf/' . $filename;
        }
        $data->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        //
    }
}
