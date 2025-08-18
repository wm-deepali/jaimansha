<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Banner;

class BannerController extends Controller
{

    public function index(){
        $banner=Banner::first();
        return view('main.layouts.index',compact('banner'));
    }


}
