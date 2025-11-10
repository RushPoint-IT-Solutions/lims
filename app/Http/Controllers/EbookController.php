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
                $q->where('isbn', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('book_title', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $ebooks = $query->paginate(10)->appends($request->all()); 
        return view('digital.ebooks.index', compact('ebooks'));
    }

    public function show($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('digital.ebooks.show', compact('ebook'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|string|max:255',
        ]);

        if (Ebook::where('isbn', $request->isbn)->where('deleted_at', NULL)->exists()) {
            Alert::error('Duplicate Entry', 'ISBN with this name already exists!')->persistent('Dismiss');
            return back();
        }

        $data = new Ebook();
        $data->book_title = $request->new_book_title ?? $request->existing_book_title;
        $data->author_name = $request->author_name;
        $data->isbn = $request->isbn;
        $data->publisher = $request->publisher;
        $data->publication_year = $request->publication_year;
        $data->page_count = $request->page_count;
        if ($request->hasFile('cover_image_path')) {
            $file = $request->file('cover_image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ebooks'), $filename);
            $data->cover_image_path = 'uploads/ebooks/' . $filename;
        }
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ebooks_pdf'), $filename);
            $data->file_path = 'uploads/ebooks_pdf/' . $filename;
        }
        $data->save();

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    public function update(Request $request, $id)
    {
        $data = Ebook::findOrFail($id);
        $data->book_title = $request->book_title;
        $data->author_name = $request->author_name;
        $data->isbn = $request->isbn;
        $data->publisher = $request->publisher;
        $data->publication_year = $request->publication_year;
        $data->page_count = $request->page_count;
        if ($request->hasFile('cover_image_path')) {
            if ($data->cover_image_path && file_exists(public_path($data->cover_image_path))) {
                unlink(public_path($data->cover_image_path));
            }

            $file = $request->file('cover_image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ebooks'), $filename);
            $data->cover_image_path = 'uploads/ebooks/' . $filename;
        }

        if ($request->hasFile('file_path')) {
            if ($data->file_path && file_exists(public_path($data->file_path))) {
                unlink(public_path($data->file_path));
            }

            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ebooks_pdf'), $filename);
            $data->file_path = 'uploads/ebooks_pdf/' . $filename;
        }
        $data->save();
        
        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    public function destroy(Request $request)
    {
        $data = Ebook::findOrFail($request->id);
        $data->delete();

        Alert::success('Successfully Deleted')->persistent('Dismiss');
        return back();
    }
}