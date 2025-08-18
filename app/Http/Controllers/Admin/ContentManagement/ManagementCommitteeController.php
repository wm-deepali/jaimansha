<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\ManagementCommittee;
use App\Models\admin\contentmanagment\GovernmentCategory;
use Illuminate\Support\Facades\File;

class ManagementCommitteeController extends Controller
{
    // 📌 Show all committee members
    public function index()
    {
        // $members = ManagementCommittee::with('category')->latest()->get();
        $members = ManagementCommittee::orderBy('id', 'desc')->get();
        $categories = GovernmentCategory::all();

        return view('admin.managementcommittee.index', compact('members', 'categories'));
    }

    // 📌 Store new committee member
 public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'designation' => 'required|string',
        'member_category' => 'required|exists:government_category,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        'status' => 'required|in:active,inactive' // 👈 fix here
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/management'), $imageName);
        $imagePath = 'uploads/management/' . $imageName;
    }

    ManagementCommittee::create([
        'name' => $request->name,
        'designation' => $request->designation,
        'member_category' => $request->member_category,
        'image' => $imagePath,
        'status' => $request->status, // 👈 directly "Active"/"Inactive"
    ]);

    return redirect()->back()->with('success', 'Member added successfully.');
}


    // 📌 Edit (fetch data via Ajax)
    public function edit($id)
    {
        $member = ManagementCommittee::findOrFail($id);
        return response()->json($member);
    }

    // 📌 Update member
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'designation' => 'required|string',
        'member_category' => 'required|exists:government_category,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        'status' => 'required|in:active,inactive' // 👈 fix here
    ]);

    $member = ManagementCommittee::findOrFail($id);

    if ($request->hasFile('image')) {
        if ($member->image && File::exists(public_path($member->image))) {
            File::delete(public_path($member->image));
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/management'), $imageName);
        $member->image = 'uploads/management/' . $imageName;
    }

    $member->update([
        'name' => $request->name,
        'designation' => $request->designation,
        'member_category' => $request->member_category,
        'status' => $request->status, // 👈 directly "Active"/"Inactive"
        'image' => $member->image,
    ]);

    return redirect()->back()->with('success', 'Member updated successfully.');
}



    // 📌 Delete member
    public function destroy($id)
    {
        $member = ManagementCommittee::findOrFail($id);

        // Delete image if exists
        if ($member->image && File::exists(public_path($member->image))) {
            File::delete(public_path($member->image));
        }

        $member->delete();

        return redirect()->back()->with('success', 'Member deleted successfully.');
    }
}


