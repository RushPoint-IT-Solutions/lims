<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogMetadataController extends Controller 
{
    public function index()
    {
        return view('catalog_metadata');
    }
}
