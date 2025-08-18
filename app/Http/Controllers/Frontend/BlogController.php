<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Blog;
use App\Models\Frontend\BlogCategory;

class BlogController extends Controller
{
        public function index()
    {
        $blogs = Blog::with('category') // Load blog category relation
                     ->where('status', 'Active')
                     ->orderBy('id', 'desc')
                     ->paginate(3);

        return view('frontend.blog.index', compact('blogs'));
    }


// public function show($slug)
// {
//     $blogs = Blog::with('category')->where('slug', $slug)->firstOrFail();

//     $allCategories = BlogCategory::where('status', 'Active')->get();

//     return view('frontend.blog_details.index', compact('blogs', 'allCategories'));
// }

public function show($slug)
{
    $blogs = Blog::with('category')->where('slug', $slug)->firstOrFail();

    $otherBlogs = Blog::where('status', 'Active')
        ->where('slug', '!=', $slug) // exclude current blog
        ->latest()
        ->take(5)
        ->get();

    return view('frontend.blog_details.index', compact('blogs', 'otherBlogs'));
}


}
