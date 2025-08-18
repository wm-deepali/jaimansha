<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\scholarship\ScholarshipContent;
use App\Models\admin\scholarship\ScholarshipEnquiry;
use App\Models\admin\scholarship\ScholarshipForm;

class ScholarshipController extends Controller
{
     public function index()
    {
        $contents = ScholarshipContent::first();
        $form = ScholarshipForm::first(); // ya specific id se: ScholarshipForm::find(1);

        return view('frontend.scholarship.index', compact('contents', 'form'));
    }

     public function store(Request $request)
    {
        // ✅ Validate request
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'scholarship_id' => 'required|exists:scholarships,id',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'school_name' => 'required|string|max:255',
            'studying_in' => 'required|string|max:255',
            'income' => 'required|string|max:255',
            'address' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'scholarship_amount' => 'required|string',
            'purpose' => 'required|string',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // ✅ Handle file upload
        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('scholarship_docs', 'public');
        }

        // ✅ Save to DB
        ScholarshipEnquiry::create([
            'name' => $validated['full_name'],
            'father_name' => $validated['father_name'],
            'dob' => $validated['dob'],
            'school_name' => $validated['school_name'],
            'class' => $validated['studying_in'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'address' => $validated['address'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'status' => 'Pending',
            'special_circumstance' => $validated['purpose'],
            'added_date' => now(),
            'scholarship_id' => $request->scholarship_id, // You can modify if linking to a scholarship
            // 'document_path' => $documentPath, // Add in model + migration if needed
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }
}
