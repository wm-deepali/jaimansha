<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppliedJob;
use App\Models\Job;

class CareerController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('frontend.career.index', compact('jobs'));
    }

    public function apply(Request $request)
    {
        $request->validate([
            'applied_post' => 'required|string|max:100',
            'other_job' => 'nullable|string|max:100|required_if:applied_post,other',
            'qualification' => 'required|string|max:255',
            'total_experience' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'message' => 'nullable|string',
        ]);

        $jobTitle = $request->applied_post === 'other' ? $request->other_job : $request->applied_post;

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resumes'), $filename);
            $resumePath = $filename; // Save in storage/app/public/resumes
        }

        AppliedJob::create([
            'applied_post' => $jobTitle,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->phone,
            'resume_path' => $resumePath,
            'message' => $request->message,
            'qualification' => $request->qualification,
            'total_experience' => $request->total_experience,
        ]);

        return response()->json(['success' => 'Application submitted successfully!']);
    }


}
