<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\AboutUs;
use App\Models\admin\contentmanagment\VisionAndMission;

class AboutUsController extends Controller
{

   public function index()
{
    // Get first about us record
    $aboutUs = AboutUs::first();

    // Get first vision and mission record
    $visionAndMission = VisionAndMission::first();

    // Pass both variables to the view
    return view('frontend.aboutus.index', compact('aboutUs', 'visionAndMission'));
}

}
