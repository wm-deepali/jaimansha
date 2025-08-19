<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marquee;
use App\Models\Popup;

class HomeController extends Controller
{

    public function index()
    {
        $marqueeMessages = Marquee::all();  // Fetch all marquee messages
          $popup = Popup::with('images')->where('active', 1)->first();
        return view('frontend.home.index', compact('marqueeMessages', 'popup'));
    }

}
