<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\VisionAndMission;
use Illuminate\Support\Facades\File;

class VisionMissionController extends Controller
{
    // ✅ Show all Vision & Mission entries
    public function index()
    {
        $vision = VisionAndMission::all();
        return view('admin.vision.index', compact('vision'));
    }

    // ✅ Show form to add new entry
    public function create()
    {
        return view('admin.vision.create');
    }

    // ✅ Store new Vision & Mission
public function store(Request $request)
{
    $request->validate([
        'heading' => 'required|string', // removed max:255
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        'status' => 'required|in:active,inactive',
    ]);

    $data = $request->only(['heading', 'description', 'status','image']);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/vision'), $imageName);
        $data['image'] = $imageName;
    }

    VisionAndMission::create($data);

    return redirect()->route('admin.vision.index')->with('success', 'Vision & Mission added successfully.');
}

    // ✅ Show form to edit entry
    public function edit($id)
    {
        $vision = VisionAndMission::findOrFail($id);
        return view('admin.vision.edit', compact('vision'));
    }

    // ✅ Update existing entry
    public function update(Request $request, $id)
    {
        $vision = VisionAndMission::findOrFail($id);

       $request->validate([
        'heading' => 'required|string', // removed max:255
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        'status' => 'required|in:active,inactive',
    ]);


        $data = $request->only(['heading', 'description', 'status','image']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($vision->image && File::exists(public_path('uploads/vision/' . $vision->image))) {
                File::delete(public_path('uploads/vision/' . $vision->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/vision'), $imageName);
            $data['image'] = $imageName;
        }

        $vision->update($data);

        return redirect()->route('admin.vision.index')->with('success', 'Vision & Mission updated successfully.');
    }

    // ✅ Delete entry
    public function destroy($id)
    {
        $vision = VisionAndMission::findOrFail($id);

        // Delete image from folder
        if ($vision->image && File::exists(public_path('uploads/vision/' . $vision->image))) {
            File::delete(public_path('uploads/vision/' . $vision->image));
        }

        $vision->delete();

        return redirect()->route('admin.vision.index')->with('success', 'Vision & Mission deleted successfully.');
    }

    // ✅ Toggle status (active/inactive)
    public function toggleStatus($id)
    {
        $vision = VisionAndMission::findOrFail($id);
        $vision->status = $vision->status === 'active' ? 'inactive' : 'active';
        $vision->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
