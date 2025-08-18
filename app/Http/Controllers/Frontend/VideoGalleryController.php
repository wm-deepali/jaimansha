<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
     public function index(){
        return view('frontend.videogallery.index');
     }
}
