<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenaltyComputationController extends Controller
{
    public function index()
    {
        return view('penalty_computation');
    }
}
