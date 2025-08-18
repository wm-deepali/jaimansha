<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\EMagazine;

class EMagazineCoverController extends Controller
{
    // Show all active publications for frontend
    public function index()
    {
        $magazines = EMagazine::all();
        return view('frontend.emagazinecover.index', compact('magazines'));
    }

    // Show details of a single publication
    public function show($id)
    {
        $magazine = EMagazine::with(['author', 'category'])->findOrFail($id);
        return view('frontend.emagazinecover.show', compact('magazine'));
    }
}
