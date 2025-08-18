<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Charity;
class CharityController extends Controller
{
      // Show all donate content
    public function index()
    {
        $donates = Charity::all();
        return view('main.layouts.index', compact('donates'));
    }

    // public function show(){
    //     return view('frontend.charity_details.index');
    // }
    
//     public function show($id)
// {
//     $charity = Charity::findOrFail($id);
//     return view('frontend.charity_details.index', compact('charity'));
// }

public function show($slug)
{
    $charity = Charity::where('slug', $slug)->firstOrFail();
    return view('frontend.charity_details.index', compact('charity'));
}

}
