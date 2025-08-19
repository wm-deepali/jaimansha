<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\EMagazine;
use App\Models\admin\Emagazine\Author;

class EMagazineController extends Controller
{
    // Show all active publications for frontend
    public function index()
    {
        $magazines = EMagazine::all();

        // Fetch writers with author_type 'writer' (adjust model and column names as per your schema)
        $writers = Author::where('author_type', 'magazine')->get();
        // dd($writers);
        return view('frontend.emagazine.index', compact('magazines', 'writers'));
    }


    // Show details of a single publication
    public function show($id)
    {
        $magazines = EMagazine::with('author')->findOrFail($id);
        return view('frontend.emagazine_details.index', compact('magazines'));
    }


    public function showWriter($id)
    {
        // Get the writer by id if needed:
        // $writer = Author::findOrFail($id);

        // Get all magazines/articles by this writer
        $articles = EMagazine::where('author_id', $id)->get();

        return view('frontend.writer_articles', compact('articles'));
    }


}
