<?php

namespace App\Http\Controllers\Admin\BlogsFaq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\blogsfaq\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogCategoryController extends Controller
{
    /**
     * Show all blog categories
     */
    public function index()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.blogs.categories.index', compact('categories'));
    }

    /**
     * Store a new blog category
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/blog_categories');
            $image->move($destination, $imageName);
            $imagePath = 'uploads/blog_categories/' . $imageName; // relative public path
        }

       BlogCategory::create([
    'category_name' => $request->category_name,
    'slug' => Str::slug($request->category_name),
    'written_by' => $request->written_by, // ✅ Added this line
    'meta_title' => $request->meta_title,
    'meta_keywords' => $request->meta_keywords,
    'meta_description' => $request->meta_description,
    'status' => $request->status,
    'image' => $imagePath,
]);


        return redirect()->back()->with('success', 'Category added successfully!');
    }

    /**
     * Get the data for edit
     */
 public function edit($id)
{
    $blog = Blog::findOrFail($id); // Correct model
    $categories = BlogCategory::all(); // All categories for dropdown

    return view('admin.blog.edit', compact('blog', 'categories'));
}

    /**
     * Update the blog category
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = BlogCategory::findOrFail($id);
        $imagePath = $category->image;

        // Check and upload new image
        if ($request->hasFile('image')) {
            // Delete old image from public directory
            if ($imagePath && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/blog_categories');
            $image->move($destination, $imageName);
            $imagePath = 'uploads/blog_categories/' . $imageName;
        }

      $category->update([
    'category_name' => $request->category_name,
    'slug' => Str::slug($request->category_name),
    'written_by' => $request->written_by, // ✅ Added this line
    'meta_title' => $request->meta_title,
    'meta_keywords' => $request->meta_keywords,
    'meta_description' => $request->meta_description,
    'status' => $request->status,
    'image' => $imagePath,
]);


        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    /**
     * Delete the category
     */
    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);

        // Delete image from public folder
        if ($category->image && File::exists(public_path($category->image))) {
            File::delete(public_path($category->image));
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
