<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminConfigurationController extends Controller
{
    public function index()
    {
        return view('admin_configuration');
    }
}
