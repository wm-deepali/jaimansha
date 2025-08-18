<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\volunteers\BecomeVolunteerModel;

class BecomeVolunttersController extends Controller
{
    // Show the volunteer form (optional)
    public function index()
    {
        return view('frontend.become_volunteers.index');  // Aapka blade form yahan hoga
    }

    // Store the submitted volunteer form data
    public function store(Request $request)
    {
        // Validation rules same as admin controller
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'mobile_number' => 'required|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'skills' => 'nullable|string',
            'availability' => 'nullable|string',
            'motivation' => 'nullable|string',
            'experience' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:100',
            'emergency_mobile' => 'nullable|string|max:20',
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',  // Max 2MB
        ]);

        // Handle resume file upload
        if ($request->hasFile('resume_file')) {
            $file = $request->file('resume_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/resumes'), $filename);
            $validated['resume_file'] = $filename;
        }

        // Save to DB
        BecomeVolunteerModel::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for volunteering! We will get back to you soon.');
    }
}
