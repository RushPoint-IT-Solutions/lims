<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EBooksController extends Controller
{
    public function index()
    {
        return view('e-books');
    }
}
