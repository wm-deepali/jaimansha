<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\gallery\Media;
use App\Models\admin\gallery\Category;
use Illuminate\Support\Facades\File;

class GalleryMediaController extends Controller
{
    // Show all media
    public function index()
    {
        $media = Media::with('category')->latest()->get();
        $categories = Category::orderBy('category_name')->get();

        return view('admin.gallery.media.index', compact('media', 'categories'));
    }

    // Store new media
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'file' => 'required|mimes:jpg,jpeg,png,mp4,mov|max:51200', // 50MB max
            'media_type' => 'required|in:image,video',
            'category_id' => 'required|exists:gallery_categories,id',
        ]);

        // Upload file
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = public_path('uploads/gallery/');
        $file->move($path, $filename);

        Media::create([
            'title' => $request->title,
            'file_path' => 'uploads/gallery/' . $filename,
            'media_type' => $request->media_type,
            'category_id' => $request->category_id,
            'status' => 'active',
            'created_by' => 'admin', // Or use auth if needed
        ]);

        return redirect()->back()->with('success', 'Media added successfully.');
    }

    // Update media
    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'media_type' => 'required|in:image,video',
            'category_id' => 'required|exists:gallery_categories,id',
        ]);

        $media->title = $request->title;
        $media->media_type = $request->media_type;
        $media->category_id = $request->category_id;

        // File update if given
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:jpg,jpeg,png,mp4,mov|max:51200'
            ]);

            // Delete old file
            if (File::exists(public_path($media->file_path))) {
                File::delete(public_path($media->file_path));
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/gallery/');
            $file->move($path, $filename);

            $media->file_path = 'uploads/gallery/' . $filename;
        }

        $media->save();

        return redirect()->back()->with('success', 'Media updated successfully.');
    }

    // Delete media
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        if (File::exists(public_path($media->file_path))) {
            File::delete(public_path($media->file_path));
        }

        $media->delete();

        return redirect()->back()->with('success', 'Media deleted successfully.');
    }

    // Toggle status (Optional)
    public function toggleStatus($id)
    {
        $media = Media::findOrFail($id);
        $media->status = $media->status === 'active' ? 'inactive' : 'active';
        $media->save();

        return redirect()->back()->with('success', 'Media status updated.');
    }
}
