<?php

namespace App\Http\Controllers\Admin\ScholarshipManagement;

use App\Http\Controllers\Controller;
use App\Models\admin\scholarship\ScholarshipForm as Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScholarshipController extends Controller
{


      // 📥 Show all scholarships
    public function index()
    {
        $data = Scholarship::orderBy('id', 'DESC')->get();
        return view('admin.scholarships.index', compact('data'));
    }

    // ➕ Show add form
    public function create()
    {
        return view('admin.scholarships.create');
    }

    // 💾 Store new scholarship
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:scholarships,title',
            'slug' => 'required|unique:scholarships,slug',
            'description' => 'required',
        ]);

        $scholarship = new Scholarship();
        $scholarship->title = $request->title;
        $scholarship->slug = Str::slug($request->slug);
        $scholarship->description = $request->description;
        $scholarship->eligibility = $request->eligibility;
        $scholarship->benefits = $request->benefits;
        $scholarship->application_process = $request->application_process;
        $scholarship->document_required = $request->document_required;
        $scholarship->amount = $request->amount;
        $scholarship->deadline = $request->deadline;
        $scholarship->category = $request->category;
        $scholarship->level = $request->level;
        $scholarship->contact_email = $request->contact_email;
        $scholarship->official_website = $request->official_website;
        $scholarship->is_featured = $request->is_featured ?? 0;
        $scholarship->image = $request->image ?? null;
        $scholarship->meta_title = $request->meta_title;
        $scholarship->meta_keywords = $request->meta_keywords;
        $scholarship->meta_description = $request->meta_description;
        $scholarship->status = $request->status ?? 1;

        $scholarship->save();

        return redirect()->route('admin.scholarships.index')->with('success', 'Scholarship added successfully.');
    }

    // ✏️ Show edit form
    public function edit($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        return view('admin.scholarships.edit', compact('scholarship'));
    }

    // 🔄 Update scholarship
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:scholarships,slug,' . $id,
            'description' => 'required',
        ]);

        $scholarship = Scholarship::findOrFail($id);
        $scholarship->update([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'eligibility' => $request->eligibility,
            'benefits' => $request->benefits,
            'application_process' => $request->application_process,
            'document_required' => $request->document_required,
            'amount' => $request->amount,
            'deadline' => $request->deadline,
            'category' => $request->category,
            'level' => $request->level,
            'contact_email' => $request->contact_email,
            'official_website' => $request->official_website,
            'is_featured' => $request->is_featured ?? 0,
            'image' => $request->image ?? null,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.scholarships.index')->with('success', 'Scholarship updated successfully.');
    }

    // ❌ Delete scholarship
    public function delete($id)
    {
        Scholarship::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Scholarship deleted successfully.');
    }
}
