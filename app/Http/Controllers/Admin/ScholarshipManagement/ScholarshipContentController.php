<?php

namespace App\Http\Controllers\Admin\ScholarshipManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\scholarship\ScholarshipContent;

class ScholarshipContentController extends Controller
{
    public function index()
    {
        $contents = ScholarshipContent::all();
        return view('admin.scholarship_content.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.scholarship_content.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_1' => 'required|string|max:255',
            'title_2' => 'required|string|max:255',
            'title_3' => 'required|string|max:255',
            'short_description_1' => 'required|string',
            'short_description_2' => 'required|string',
        ]);

        ScholarshipContent::create($request->all());

        return redirect()->route('admin.scholarship_content.index')->with('success', 'Content created successfully.');
    }

    public function edit($id)
    {
        $content = ScholarshipContent::findOrFail($id);
        return view('admin.scholarship.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_1' => 'required|string|max:255',
            'title_2' => 'required|string|max:255',
            'title_3' => 'required|string|max:255',
            'short_description_1' => 'required|string',
            'short_description_2' => 'required|string',
        ]);

        $content = ScholarshipContent::findOrFail($id);
        $content->update($request->all());

        return redirect()->route('admin.scholarship_content.index')->with('success', 'Content updated successfully.');
    }

    public function destroy($id)
    {
        ScholarshipContent::destroy($id);
        return redirect()->route('admin.scholarship_content.index')->with('success', 'Content deleted successfully.');
    }
}
