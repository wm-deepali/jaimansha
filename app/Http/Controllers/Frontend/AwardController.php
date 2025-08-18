<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\admin\contentmanagment\Award;  // Model ka path check karo
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::all();  // Model se sab data le rahe hain

        return view('frontend.award.index', compact('awards'));
    }
}
