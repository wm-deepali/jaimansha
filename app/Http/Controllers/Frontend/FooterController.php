<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Footer;

class FooterController extends Controller
{
     public function index()
    {
        // Footer ke saath uska related Header fetch karo
        $footer = Footer::with('header')->first(); // assuming only one footer record hai

        return view('main.layouts.index', compact('footer'));
    }


}
