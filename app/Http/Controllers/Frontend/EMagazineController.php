<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\EMagazine;
use App\Models\Admin\Emagazine\Author;

class EMagazineController extends Controller
{
    // Show all active publications for frontend
    public function index()
    {
        $magazines = EMagazine::all();

        return view('frontend.emagazine.index', compact('magazines'));
    }

    // Show details of a single publication
      public function show($id)
    {
        $magazines = EMagazine::with('author')->findOrFail($id);
        return view('frontend.emagazine_details.index', compact('magazines'));
    }
}
