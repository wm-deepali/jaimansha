<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
            public function index()
    {
        // Future mein agar aapko model se data bhejna ho to yahaan handle kar sakte ho
        // Example: $activities = CoScholastic::all();
        // return view('frontend.co_scholastic', compact('activities'));

        return view('frontend.reports.index');
    }
}
