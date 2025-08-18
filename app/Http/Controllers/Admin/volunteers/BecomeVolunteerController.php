<?php

namespace App\Http\Controllers\admin\volunteers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\volunteers\BecomeVolunteerModel;

class BecomeVolunteerController extends Controller
{
    // List all volunteers
    public function index()
    {
        $volunteers = BecomeVolunteerModel::latest()->paginate(10);
        return view('admin.become_volunteers.index', compact('volunteers'));
    }

    // Show form to create new volunteer entry
    public function create()
    {
        return view('admin.become_volunteers.create');
    }

    // Store new volunteer entry
    public function store(Request $request)
    {
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

        // Handle resume upload
        if ($request->hasFile('resume_file')) {
            $file = $request->file('resume_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/resumes'), $filename);
            $validated['resume_file'] = $filename;
        }

        BecomeVolunteerModel::create($validated);

        return redirect()->route('admin.become_volunteers.index')->with('success', 'Volunteer added successfully.');
    }

    // Show single volunteer details
    public function show($id)
    {
        $volunteer = BecomeVolunteerModel::findOrFail($id);
        return view('admin.become_volunteers.show', compact('volunteer'));
    }

    // Show form to edit volunteer
    public function edit($id)
    {
        $volunteer = BecomeVolunteerModel::findOrFail($id);
        return view('admin.become_volunteers.edit', compact('volunteer'));
    }

    // Update volunteer entry
    public function update(Request $request, $id)
    {
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
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $volunteer = BecomeVolunteerModel::findOrFail($id);

        // Handle resume upload and replace old file if uploaded
        if ($request->hasFile('resume_file')) {
            // Optional: Delete old resume file if exists
            if ($volunteer->resume_file && file_exists(public_path('uploads/resumes/' . $volunteer->resume_file))) {
                unlink(public_path('uploads/resumes/' . $volunteer->resume_file));
            }

            $file = $request->file('resume_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/resumes'), $filename);
            $validated['resume_file'] = $filename;
        }

        $volunteer->update($validated);

        return redirect()->route('admin.become_volunteers.index')->with('success', 'Volunteer updated successfully.');
    }

    // Delete volunteer entry
    public function destroy($id)
    {
        $volunteer = BecomeVolunteerModel::findOrFail($id);

        // Optional: Delete resume file from storage
        if ($volunteer->resume_file && file_exists(public_path('uploads/resumes/' . $volunteer->resume_file))) {
            unlink(public_path('uploads/resumes/' . $volunteer->resume_file));
        }

        $volunteer->delete();

        return redirect()->route('admin.become_volunteers.index')->with('success', 'Volunteer deleted successfully.');
    }
}
