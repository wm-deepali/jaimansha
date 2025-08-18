<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\blogsfaq\FAQ;

class FaqControllerController extends Controller
{
     public function index()
    {
         $faq=FAQ::all();

        return view('frontend.legal.index',compact('faq'));
    }
}
