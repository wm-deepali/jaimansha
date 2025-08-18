<?php

namespace App\Http\Controllers\Admin\BlogsFaq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\blogsfaq\Blog;
use Illuminate\Support\Str;
use App\Models\admin\blogsfaq\BlogCategory;
use Illuminate\Support\Facades\File;

class BlogContentController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        $categories = BlogCategory::where('status', 'Active')->get();

        return view('admin.blogs.contents.index', compact('blogs', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'category_id'       => 'required|exists:blog_categories,id',
            'short_description' => 'nullable|string',
            'detail_content'    => 'required|string',
            'banner_image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'thumbnail_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keywords'     => 'nullable|string',
            'meta_description'  => 'nullable|string',
            'status'            => 'required|in:Active,Inactive',
        ]);

        $bannerPath = null;
        $thumbPath  = null;

        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerName = uniqid() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/blogs'), $bannerName);
            $bannerPath = 'uploads/blogs/' . $bannerName;
        }

        if ($request->hasFile('thumbnail_image')) {
            $thumb = $request->file('thumbnail_image');
            $thumbName = uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('uploads/blogs'), $thumbName);
            $thumbPath = 'uploads/blogs/' . $thumbName;
        }

        Blog::create([
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'category_id'       => $request->category_id,
            'short_description' => $request->short_description,
            'detail_content'    => $request->detail_content,
            'banner_image'      => $bannerPath,
            'thumbnail_image'   => $thumbPath,
            'meta_title'        => $request->meta_title,
            'meta_keywords'     => $request->meta_keywords,
            'meta_description'  => $request->meta_description,
            'status'            => $request->status,
        ]);

        return redirect()->back()->with('success', 'Blog added successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title'             => 'required|string|max:255',
            'category_id'       => 'required|exists:blog_categories,id',
            'short_description' => 'nullable|string',
            'detail_content'    => 'required|string',
            'banner_image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'thumbnail_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keywords'     => 'nullable|string',
            'meta_description'  => 'nullable|string',
            'status'            => 'required|in:Active,Inactive',
        ]);

        // Image paths
        $bannerPath = $blog->banner_image;
        $thumbPath  = $blog->thumbnail_image;

        if ($request->hasFile('banner_image')) {
            // Delete old file
            if ($blog->banner_image && File::exists(public_path($blog->banner_image))) {
                File::delete(public_path($blog->banner_image));
            }

            $banner = $request->file('banner_image');
            $bannerName = uniqid() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/blogs'), $bannerName);
            $bannerPath = 'uploads/blogs/' . $bannerName;
        }

        if ($request->hasFile('thumbnail_image')) {
            // Delete old file
            if ($blog->thumbnail_image && File::exists(public_path($blog->thumbnail_image))) {
                File::delete(public_path($blog->thumbnail_image));
            }

            $thumb = $request->file('thumbnail_image');
            $thumbName = uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('uploads/blogs'), $thumbName);
            $thumbPath = 'uploads/blogs/' . $thumbName;
        }

        $blog->update([
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'category_id'       => $request->category_id,
            'short_description' => $request->short_description,
            'detail_content'    => $request->detail_content,
            'banner_image'      => $bannerPath,
            'thumbnail_image'   => $thumbPath,
            'meta_title'        => $request->meta_title,
            'meta_keywords'     => $request->meta_keywords,
            'meta_description'  => $request->meta_description,
            'status'            => $request->status,
        ]);

        return redirect()->back()->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->banner_image && File::exists(public_path($blog->banner_image))) {
            File::delete(public_path($blog->banner_image));
        }

        if ($blog->thumbnail_image && File::exists(public_path($blog->thumbnail_image))) {
            File::delete(public_path($blog->thumbnail_image));
        }

        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully!');
    }
}
