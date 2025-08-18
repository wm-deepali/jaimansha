<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\admin\contentmanagment\Scholastic;
use Illuminate\Http\Request;

class ScholasticController extends Controller
{

    public function index()
    {
        $scholastics = Scholastic::with('coScholastics')->get();
        return view('frontend.scholastics.index', compact('scholastics'));
    }

}
