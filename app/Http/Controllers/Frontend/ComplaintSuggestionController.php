<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\admin\complaints\ComplaintSuggestionModel; // Model ka path check karein
use Illuminate\Http\Request;

class ComplaintSuggestionController extends Controller
{
    // Form show karne ke liye
    public function index()
    {
        return view('frontend.complaint_suggestions.index'); // Aapka blade form yahan hona chahiye
    }

    // Form submit handle karne ke liye
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:complaint,suggestion',
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'mobile_number' => 'required|string|max:20',
            'details' => 'required|string',
        ]);

        ComplaintSuggestionModel::create($validated);

        return redirect()->back()->with('success', 'Thank you for your submission! We will review it soon.');
    }
}
