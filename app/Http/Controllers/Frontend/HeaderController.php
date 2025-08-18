<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Header;

class HeaderController extends Controller
{
    public function index(){
      $header=Header::first();
      return view('main.layouts.index',compact('header'));
    }

}
