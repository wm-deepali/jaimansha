<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\courses\CourseContent;
use App\Models\admin\courses\CourseCategory;
use Illuminate\Support\Facades\File;

class CourseContentController extends Controller
{
    // Show all courses
    public function index()
    {
        $categories = CourseCategory::all();
        $courses = CourseContent::with('category')->orderBy('id', 'DESC')->get();
        return view('admin.courses.content.index', compact('courses', 'categories'));
    }

    // Show form to create new course
    public function create()
    {
        $categories = CourseCategory::all();
        return view('admin.courses.content.create', compact('categories'));
    }

  public function store(Request $request)
{
    $data = $request->all();

    if ($request->hasFile('banner_image')) {
        $data['banner_image'] = $request->file('banner_image')->store('courses', 'public');
    }

    if ($request->hasFile('thumbnail_image')) {
        $data['thumbnail_image'] = $request->file('thumbnail_image')->store('courses', 'public');
    }

    CourseContent::create($data);

    return redirect()->back()->with('success', 'Course added successfully.');
}

public function update(Request $request, $id)
{
    $course = CourseContent::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('banner_image')) {
        $data['banner_image'] = $request->file('banner_image')->store('courses', 'public');
    }

    if ($request->hasFile('thumbnail_image')) {
        $data['thumbnail_image'] = $request->file('thumbnail_image')->store('courses', 'public');
    }

    $course->update($data);

    return redirect()->back()->with('success', 'Course updated successfully.');
}


    // Show edit form
    public function edit($id)
    {
        $course = CourseContent::findOrFail($id);
        $categories = CourseCategory::all();
        return view('admin.courses.content.edit', compact('course', 'categories'));
    }


    // Delete course
    public function destroy($id)
    {
        $course = CourseContent::findOrFail($id);

        $this->deleteOldImage($course->banner_image, 'banners');
        $this->deleteOldImage($course->thumbnail_image, 'thumbnails');

        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }

    // Calculate Offered Price
    private function calculateOfferedPrice(Request $request)
    {
        $fee = $request->course_fee;
        $percent = $request->discount_percentage;
        $amount = $request->discount_amount;

        if ($percent > 0) {
            return $fee - ($fee * $percent / 100);
        } elseif ($amount > 0) {
            return $fee - $amount;
        }

        return $fee;
    }

    // Upload Image
    private function uploadImage($file, $folder)
    {
        $name = time() . '_' . $folder . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("uploads/courses/{$folder}"), $name);
        return $name;
    }

    // Delete Old Image
    private function deleteOldImage($filename, $folder)
    {
        $path = public_path("uploads/courses/{$folder}/{$filename}");
        if ($filename && File::exists($path)) {
            File::delete($path);
        }
    }
}
