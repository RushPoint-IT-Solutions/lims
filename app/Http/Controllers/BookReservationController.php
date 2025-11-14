<?php

namespace App\Http\Controllers;

use App\BookReservation;
use App\Cataloging;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BookReservationController extends Controller
{
   public function index(Request $request)
    {
        $query = BookReservation::with(['books', 'authors', 'users']);
        $books = Cataloging::with(['authors', 'types', 'branches', 'racks'])->get();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');

            $query->whereHas('books', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('floor', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $book_reservations = $query->paginate(10)->appends($request->all());
        return view('circulation.books_reservation.index', compact('book_reservations', 'books'));
    }


    public function reserve($bookId)
    {
        $existingReservation = BookReservation::where('book_id', $bookId)
            ->where('status', 'Ready for Pickup')
            ->first();

        if ($existingReservation) {
            Alert::warning('Unavailable', 'This book is already reserved and ready for pickup.')
                ->persistent('Dismiss');
            return back();
        }

        $year = date('Y');

        $lastReservation = BookReservation::where('reservation_id', 'LIKE', "RSV-$year-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastReservation) {
            preg_match('/RSV-\d{4}-(\d+)/', $lastReservation->reservation_id, $matches);
            $nextNumber = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        } else {
            $nextNumber = 1;
        }

        $reservationId = sprintf("RSV-%s-%03d", $year, $nextNumber);

        BookReservation::create([
            'reservation_id' => $reservationId,
            'book_id' => $bookId,
            'reserved_by' => auth()->id(),
            'reserved_date' => now(),
            'status' => 'Active - In Queue',
        ]);

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
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
