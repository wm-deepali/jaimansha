<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Certification;
use Illuminate\Support\Facades\Storage;

class AwardsCertificationsController extends Controller
{
   // 🔸 Show all certifications
    public function index()
    {
        $certifications = Certification::all();
        return view('admin.certifications.index', compact('certifications'));
    }

    // 🔸 Store new certification
    public function store(Request $request)
    {

// $request->validate([
//     'title' => 'required|string|max:255',
//     'pdf' => 'required|mimes:pdf',
//     'year' => 'required|digits:4|integer|min:1900|max:2035',
//     'status' => 'required|in:active,inactive',
//     'type' => 'required|in:annual_reports,management_committee', // ✅ added
// ]);


        $pdfPath = $request->file('pdf')->store('certifications', 'public');

     Certification::create([
    'title' => $request->title,
    'pdf' => $pdfPath,
    'year' => $request->year,
    'status' => $request->status,
    'type' => $request->type,
]);

        return redirect()->back()->with('success', 'Certification added successfully!');
    }

public function update(Request $request, $id)
{
    $certification = Certification::findOrFail($id);

    // $request->validate([
    //     'title' => 'nullable|string|max:255',
    //     'pdf' => 'nullable|mimes:pdf',
    //     'year' => 'nullable|digits:4|integer|min:1900|max:2035',
    //     'status' => 'nullable|in:active,inactive',
    //     'type' => 'nullable|in:annual_reports,management_committee',
    // ]);

    $data = [];

    if ($request->has('title')) {
        $data['title'] = $request->title;
    }

    if ($request->has('status')) {
        $data['status'] = $request->status;
    }

    if ($request->has('year')) {
        $data['year'] = $request->year;
    }

    if ($request->has('type')) {
        $data['type'] = $request->type;
    }

    if ($request->hasFile('pdf')) {
        // Delete old file
        if ($certification->pdf) {
            Storage::disk('public')->delete($certification->pdf);
        }

        // Upload new file
        $data['pdf'] = $request->file('pdf')->store('certifications', 'public');
    }

    $certification->update($data);

    return redirect()->back()->with('success', 'Certification updated successfully!');
}

    // 🔸 Delete certification
    public function destroy($id)
    {
        $certification = Certification::findOrFail($id);

        // Delete PDF file
        Storage::disk('public')->delete($certification->pdf);

        $certification->delete();

        return redirect()->back()->with('success', 'Certification deleted successfully!');
    }
}
