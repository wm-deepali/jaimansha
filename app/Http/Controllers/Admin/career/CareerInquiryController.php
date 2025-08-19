<?php

namespace App\Http\Controllers\Admin\career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppliedJob;


class CareerInquiryController extends Controller
{

    // Display a paginated list of applied jobs
    public function index()
    {
        $applied_jobs = AppliedJob::latest()->paginate(10);
        return view('admin.career_inquiries.index', compact('applied_jobs'));
    }

    // Show all details of a single application
    public function show($id)
    {
        $applied_job = AppliedJob::findOrFail($id);
        return view('admin.career_inquiries.show', compact('applied_job'));
    }

    // Delete a career inquiry
    public function destroy($id)
    {
        $applied_job = AppliedJob::findOrFail($id);
        $applied_job->delete();

        return redirect()->route('admin.career_inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}

