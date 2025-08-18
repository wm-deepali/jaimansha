<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\gallery\Media;
use App\Models\admin\gallery\Category;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{

 public function index(){
    $media = Media::with('category')->latest()->get();

    $categories = Category::whereHas('media', function($query) {
        $query->where('media_type', 'image');
    })->get();

        $videoCategories = Category::with(['media' => function($q) {
        $q->where('media_type', 'video');
    }])->whereHas('media', function($q) {
        $q->where('media_type', 'video');
    })->get();


    return view('frontend.gallery.index', compact('media', 'categories','videoCategories'));
}

}
