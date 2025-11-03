<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EResourcesController extends Controller
{
    public function index()
    {
        return view('e_resources');
    }
}
