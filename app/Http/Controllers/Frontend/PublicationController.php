<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\emagazine\Publication;

class PublicationController extends Controller
{
         public function index()
    {
        $publication=Publication::paginate(3);
        return view('frontend.publication.index',compact('publication'));
    }

  public function show($id)
{
    $publication = Publication::findOrFail($id);
    return view('frontend.publication_details.index', compact('publication'));
}

}
