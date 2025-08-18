<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\LegalPanel as Legal;

class LegalController extends Controller
{
         public function index()
    {
         $legal=Legal::all();

        return view('frontend.legal.index',compact('legal'));
    }
}
