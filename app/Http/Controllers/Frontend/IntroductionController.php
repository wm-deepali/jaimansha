<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Introduction;
use App\Models\Frontend\VisionAndMission;


class IntroductionController extends Controller
{
     public function index()
    {
        // Get the most recently added or updated introduction along with vision and mission
        $latestIntroduction = Introduction::with('visionAndMission')
            ->orderBy('updated_at', 'desc')
            ->first();

        $vision=VisionAndMission::first();

        return view('main.layouts.index', compact('latestIntroduction','vision'));
    }
}
