<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Scholastic;
use App\Models\admin\contentmanagment\CoScholastic;
class CoScholasticController extends Controller
{

public function index()
{
    $scholastics = Scholastic::all(); // All scholastic entries
    $coscholastics = CoScholastic::all(); // All co-scholastic entries
    return view('frontend.co_scholastic.index', compact('scholastics', 'coscholastics'));
}

}
