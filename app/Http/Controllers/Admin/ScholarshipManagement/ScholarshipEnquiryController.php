<?php

namespace App\Http\Controllers\Admin\ScholarshipManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\scholarship\ScholarshipEnquiry;
use App\Models\admin\scholarship\Scholarship;

class ScholarshipEnquiryController extends Controller
{
    // Show all enquiries
    public function index()
    {
        $enquiries = ScholarshipEnquiry::with('scholarship')->orderBy('id', 'DESC')->get();
        return view('admin.scholarshipenquiries.index', compact('enquiries'));
    }

    // Show one enquiry in detail
    public function show($id)
    {
        $enquiry = ScholarshipEnquiry::with('scholarship')->findOrFail($id);
        return view('admin.scholarshipenquiries.show', compact('enquiry'));
    }

    // Store new enquiry (if from form)
    public function store(Request $request)
    {
        $request->validate([
            'scholarship_id' => 'required|exists:scholarships,id',
            'name' => 'required|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',       // Added this
            'dob' => 'nullable|date',
            'school_name' => 'nullable|string',
            'class' => 'nullable|string',
            'email' => 'nullable|email',
            'mobile' => 'required|string|max:15',
            'address' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'special_circumstance' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['added_date'] = now();

        ScholarshipEnquiry::create($data);

        return redirect()->back()->with('success', 'Enquiry submitted successfully.');
    }

    // Update existing enquiry
    public function update(Request $request, $id)
    {
        $request->validate([
            'scholarship_id' => 'required|exists:scholarships,id',
            'name' => 'required|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',       // Added this
            'dob' => 'nullable|date',
            'school_name' => 'nullable|string',
            'class' => 'nullable|string',
            'email' => 'nullable|email',
            'mobile' => 'required|string|max:15',
            'address' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'special_circumstance' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $enquiry = ScholarshipEnquiry::findOrFail($id);

        $data = $request->all();

        $enquiry->update($data);

        return redirect()->back()->with('success', 'Enquiry updated successfully.');
    }

    // Delete enquiry
    public function destroy($id)
    {
        $enquiry = ScholarshipEnquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->back()->with('success', 'Enquiry deleted successfully.');
    }
}
