<?php

namespace App\Http\Controllers;

use App\Cataloging;
use App\Framework;
use App\Author;
use App\Type;
use App\Rack;
use App\Branch;
use App\CatalogAuthor;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CatalogMetadataController extends Controller 
{
    public function index(Request $request)
    {
        $query = Cataloging::with(['authors', 'types', 'branches', 'racks']);
        $frameworks = Framework::all();
        $authors = Author::all();
        $types = Type::all();
        $racks = Rack::all();
        $branches = Branch::all();

        $count_catalog = Cataloging::count();
       
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('isbn', 'LIKE', '%' . $searchTerm . '%')
                ->orWhereHas('authors', function ($authorQuery) use ($searchTerm) {
                    $authorQuery->where('author_name', 'LIKE', '%' . $searchTerm . '%');
                });
            });
        }
        
        $catalogings = $query->paginate(10)->appends($request->all()); 
        return view('cataloging.index', compact('catalogings', 'frameworks', 'authors', 'types', 'racks', 'branches', 'count_catalog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'framework_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'branch_id' => 'required|string|max:255',
        ]);

        $year = date('Y');

        $lastBook = Cataloging::where('barcode_id', 'LIKE', "BC-$year-%")
            ->orderBy('barcode_id', 'desc')
            ->first();

        if ($lastBook) {
            preg_match('/BC-\d{4}-(\d+)/', $lastBook->barcode_id, $matches);
            $nextNumber = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        } else {
            $nextNumber = 1;
        }

        $barcodeId = sprintf("BC-%s-%03d", $year, $nextNumber);

        $data = new Cataloging();
        $data->acquire_type = $request->acquire_type;
        $data->acquire_by = $request->acquire_by;
        $data->donate_by = $request->donate_by;
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/books'), $filename);
            $data->image_path = 'uploads/books/' . $filename;
        }
        $data->barcode_id = $barcodeId;
        $data->name = $request->name;
        $data->framework_id = $request->framework_id;
        $data->type_id = $request->type_id;
        $data->publisher = $request->publisher;
        $data->isbn = $request->isbn;
        $data->publication_year = $request->publication_year;
        $data->edition = $request->edition;
        $data->branch_id = $request->branch_id;
        $data->rack_id = $request->rack_id;
        $data->ddc = $request->ddc;
        $data->description = $request->description;
        $data->save();

        foreach ($request->author_name as $authorName) {
            CatalogAuthor::create([
                'catalog_id' => $data->id,
                'author_name' => $authorName,
            ]);
        }
        
        Alert::success('Success', 'Catalog successfully saved!')->persistent('Dismiss');
        return back();
    }

    public function update(Request $request, $id)
    {
        $data = Cataloging::findOrFail($id);
        $data->update([
            'acquire_type' => $request->acquire_type,
            'acquire_by' => $request->acquire_by,
            'donate_by' => $request->donate_by,
            'name' => $request->name,
            'framework_id' => $request->framework_id,
            'type_id' => $request->type_id,
            'publisher' => $request->publisher,
            'isbn' => $request->isbn,
            'publication_year' => $request->publication_year,
            'edition' => $request->edition,
            'branch_id' => $request->branch_id,
            'rack_id' => $request->rack_id,
            'ddc' => $request->ddc,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image_path')) {
            if ($data->image_path && file_exists(public_path($data->image_path))) {
                unlink(public_path($data->image_path));
            }
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/books'), $filename);

            $data->image_path = 'uploads/books/' . $filename;
            $data->save();
        }

        CatalogAuthor::where('catalog_id', $data->id)->delete();

        if ($request->has('author_name')) {
            foreach ($request->author_name as $authorName) {
                CatalogAuthor::create([
                    'catalog_id' => $data->id,
                    'author_name' => $authorName,
                ]);
            }
        }

        Alert::success('Success', 'Successfully Saved!')->persistent('Dismiss');
        return back();
    }

    
    // public function barcode(Request $request)
    // {
    //     $code = '081231723897'; // Barcode value

    //     // Create PNG barcode generator
    //     $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

    //     // Generate PNG barcode (Code128, width factor 2, height 50)
    //     $barcodeData = $generator->getBarcode($code, $generator::TYPE_CODE_11, 2, 50);

    //     // Output as an inline image in HTML using base64
    //     echo '<img src="data:image/png;base64,' . base64_encode($barcodeData) . '">';
    // }

    public function barcode($barcode)
    {
        // Generate PNG barcode using Picqer Barcode
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

        // Parameters: text, type, width factor, height
        $barcodeData = $generator->getBarcode($barcode, $generator::TYPE_CODE_128, 2, 50);

        // Return PNG response
        return response($barcodeData)->header('Content-Type', 'image/png');
    }
}
