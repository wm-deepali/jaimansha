<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\courses\CourseCategory;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::latest()->get();
        return view('admin.courses.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'category_name',
            'meta_title',
            'meta_keywords',
            'meta_description',
        ]);

        $data['slug'] = Str::slug($request->category_name);
        $data['status'] = $request->has('status') ? 1 : 0;

        // Handle Image
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $filename);
            $data['image'] = $filename;
        }

        CourseCategory::create($data);

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function update(Request $request, $id)
    {
        $category = CourseCategory::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'category_name',
            'meta_title',
            'meta_keywords',
            'meta_description',
        ]);

        $data['slug'] = Str::slug($request->category_name);
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $filename);
            $data['image'] = $filename;
        }

        $category->update($data);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = CourseCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
