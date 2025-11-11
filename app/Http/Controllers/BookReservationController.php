<?php

namespace App\Http\Controllers;

use App\BookReservation;
use App\Cataloging;
use Illuminate\Http\Request;

class BookReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = BookReservation::query();
        $books = Cataloging::with(['authors', 'types', 'branches', 'racks'])->get();
        // dd($books);
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('floor', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $book_reservations = $query->paginate(10)->appends($request->all()); 
        return view('circulation.books_reservation.index', compact('book_reservations', 'books'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookReservation  $bookReservation
     * @return \Illuminate\Http\Response
     */
    public function show(BookReservation $bookReservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookReservation  $bookReservation
     * @return \Illuminate\Http\Response
     */
    public function edit(BookReservation $bookReservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookReservation  $bookReservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookReservation $bookReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookReservation  $bookReservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookReservation $bookReservation)
    {
        //
    }
}
