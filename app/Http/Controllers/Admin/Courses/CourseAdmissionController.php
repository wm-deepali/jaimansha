<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\courses\AdmissionEnquiry;
use App\Models\admin\courses\CourseContent;

class CourseAdmissionController extends Controller
{
    // 📌 Display list of enquiries
public function index()
{
    // Get all enquiries
    $enquiries = AdmissionEnquiry::latest()->get();

    // All unique course names from enquiries
    $courseList = AdmissionEnquiry::select('course_interested')
                    ->distinct()
                    ->pluck('course_interested');

    // ✅ Get all courses from CourseContent model
    $courses = CourseContent::all();

    return view('admin.courses.admissionenquiries.index', compact('enquiries', 'courseList', 'courses'));
}

public function edit($id)
{
    // Specific enquiry find karo
    $enquiry = AdmissionEnquiry::findOrFail($id);

    // CourseContent se sare courses la lo dropdown ke liye
    $courses = CourseContent::all();

    // Wapas view bhejna agar separate edit page hai
    return view('admin.courses.admissionenquiries.edit', compact('enquiry', 'courses'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'course_interested' => 'required|string',
            'message' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        AdmissionEnquiry::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'course_interested' => $request->course_interested,
            'message' => $request->message,
            'status' => $request->status ?? 'new',
        ]);

        return redirect()->back()->with('success', 'Admission Enquiry Added Successfully');
    }

public function update(Request $request, $id)
{
    $request->validate([
        'course_interested' => 'required|string',
        'name' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
        'message' => 'nullable|string',
        'status' => 'required|string'
    ]);

    $enquiry = AdmissionEnquiry::findOrFail($id);

    $enquiry->update([
        'course_interested' => $request->course_interested,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'message' => $request->message,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.courses.admissionenquiries.index')
        ->with('success', 'Admission enquiry updated successfully.');
}


    public function destroy($id)
    {
        $enquiry = AdmissionEnquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->back()->with('success', 'Enquiry Deleted Successfully');
    }
}
