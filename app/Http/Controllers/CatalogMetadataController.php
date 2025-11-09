<?php

namespace App\Http\Controllers;

use App\Cataloging;
use App\Framework;
use App\Author;
use App\Type;
use App\Rack;
use App\Branch;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CatalogMetadataController extends Controller 
{
    public function index(Request $request)
    {
        $query = Cataloging::query();
        $frameworks = Framework::all();
        $authors = Author::all();
        $types = Type::all();
        $racks = Rack::all();
        $branches = Branch::all();
        
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('floor', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $catalogings  = $query->paginate(10)->appends($request->all()); 
        return view('cataloging.index', compact('catalogings', 'frameworks', 'authors', 'types', 'racks', 'branches'));
    }
}
