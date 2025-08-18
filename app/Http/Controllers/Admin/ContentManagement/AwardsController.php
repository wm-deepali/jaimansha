<?php
namespace App\Http\Controllers\admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Award;

class AwardsController extends Controller
{
    // List all awards
    public function index()
    {
        $awards = Award::all();
        return view('admin.awards.index', compact('awards'));
    }

    // Show create form
    public function create()
    {
        return view('admin.awards.create');
    }

    // Store new award
    public function store(Request $request)
    {
        $request->validate([
            'heading_1' => 'required|string|max:255',
            'heading_2' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:20480', // ✅ Accept image or PDF
        ]);

        $data = $request->only('heading_1', 'heading_2', 'title', 'description');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();

            // Store PDFs in a separate folder, images in the existing folder
            if ($file->extension() === 'pdf') {
                $file->move(public_path('uploads/awards/pdfs'), $filename);
            } else {
                $file->move(public_path('uploads/awards'), $filename);
            }

            $data['image'] = $filename;
        }

        Award::create($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $award = Award::findOrFail($id);
        return view('admin.awards.edit', compact('award'));
    }

    // Update award
    public function update(Request $request, $id)
    {
        $award = Award::findOrFail($id);

        $request->validate([
            'heading_1' => 'required|string|max:255',
            'heading_2' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:20480', // ✅ Accept image or PDF
        ]);

        $data = $request->only('heading_1', 'heading_2', 'title', 'description','image');

        if ($request->hasFile('image')) {
            // Delete old file
            if ($award->image) {
                $oldPathImage = public_path('uploads/awards/' . $award->image);
                $oldPathPDF = public_path('uploads/awards/pdfs/' . $award->image);
                if (file_exists($oldPathImage)) unlink($oldPathImage);
                if (file_exists($oldPathPDF)) unlink($oldPathPDF);
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();

            if ($file->extension() === 'pdf') {
                $file->move(public_path('uploads/awards/pdfs'), $filename);
            } else {
                $file->move(public_path('uploads/awards'), $filename);
            }

            $data['image'] = $filename;
        }

        $award->update($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    // Delete award
    public function destroy($id)
    {
        $award = Award::findOrFail($id);

        // Delete file (image or PDF)
        if ($award->image) {
            $pathImage = public_path('uploads/awards/' . $award->image);
            $pathPDF = public_path('uploads/awards/pdfs/' . $award->image);
            if (file_exists($pathImage)) unlink($pathImage);
            if (file_exists($pathPDF)) unlink($pathPDF);
        }

        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}


// namespace App\Http\Controllers\admin\ContentManagement;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\admin\contentmanagment\Award;

// class AwardsController extends Controller
// {
//     // List all awards
//     public function index()
//     {
//         $awards = Award::all();
//         return view('admin.awards.index', compact('awards'));
//     }

//     // Show create form
//     public function create()
//     {
//         return view('admin.awards.create');
//     }

//     // Store new award
//     public function store(Request $request)
//     {
//         $request->validate([
//             'heading_1' => 'required|string|max:255',
//             'heading_2' => 'required|string|max:255',
//             'title' => 'required|string|max:255',
//             'description' => 'nullable|string',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
//         ]);

//         $data = $request->only('heading_1', 'heading_2', 'title', 'description');

//         if ($request->hasFile('image')) {
//             $file = $request->file('image');
//             $filename = time().'_'.$file->getClientOriginalName();
//             $file->move(public_path('uploads/awards'), $filename);
//             $data['image'] = $filename;
//         }

//         Award::create($data);

//         return redirect()->route('admin.awards.index')->with('success', 'Award created successfully.');
//     }

//     // Show edit form
//     public function edit($id)
//     {
//         $award = Award::findOrFail($id);
//         return view('admin.awards.edit', compact('award'));
//     }

//     // Update award
//     public function update(Request $request, $id)
//     {
//         $award = Award::findOrFail($id);

//         $request->validate([
//             'heading_1' => 'required|string|max:255',
//             'heading_2' => 'required|string|max:255',
//             'title' => 'required|string|max:255',
//             'description' => 'nullable|string',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $data = $request->only('heading_1', 'heading_2', 'title', 'description','image');

//         if ($request->hasFile('image')) {
//             // Delete old image if exists
//             if ($award->image && file_exists(public_path('uploads/awards/' . $award->image))) {
//                 unlink(public_path('uploads/awards/' . $award->image));
//             }

//             $file = $request->file('image');
//             $filename = time().'_'.$file->getClientOriginalName();
//             $file->move(public_path('uploads/awards'), $filename);
//             $data['image'] = $filename;
//         }

//         $award->update($data);

//         return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
//     }

//     // Delete award
//     public function destroy($id)
//     {
//         $award = Award::findOrFail($id);

//         // Delete image file if exists
//         if ($award->image && file_exists(public_path('uploads/awards/' . $award->image))) {
//             unlink(public_path('uploads/awards/' . $award->image));
//         }

//         $award->delete();

//         return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
//     }
// }
