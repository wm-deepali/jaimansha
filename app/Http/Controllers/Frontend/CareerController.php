<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppliedJob;

class CareerController extends Controller
{
    public function index()
    {
        return view('frontend.career.index');
    }

    public function apply(Request $request)
    {
        $request->validate([
            'applied_post' => 'required|string|max:100',
            'qualification' => 'required|string|max:255',
            'total_experience' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'message' => 'nullable|string',
        ]);


        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $resumePath = $file->store('resumes', 'public'); // Save in storage/app/public/resumes
        }

        AppliedJob::create([
            'applied_post' => $request->applied_post,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->phone,
            'resume_path' => $resumePath,
            // 'message' => $request->message,
            'qualification' => $request->qualification,
            'total_experience' => $request->total_experience,
        ]);
        return response()->json(['success' => 'Application submitted successfully!']);
    }

}
