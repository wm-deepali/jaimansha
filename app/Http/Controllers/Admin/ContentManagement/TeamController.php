<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Team;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    // 📋 Show all team members
    public function index()
    {
        $members = Team::latest('joined_at')->get();
        return view('admin.team.index', compact('members'));
    }

    // ➕ Store new team member
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'status' => 'required|in:active,inactive',
            'team_type' => 'required|in:our_team,volunteers,advisor',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:20480',
            // 'joined_at' => 'required|date',
        ]);

        $fileName = null;

        if ($request->hasFile('image')) {
            $extension = $request->image->extension();
            $fileName = time() . '.' . $extension;

            // Folder: PDF for advisor, images for others
            $folder = ($request->team_type == 'advisor') ? 'uploads/team/pdfs' : 'uploads/team';
            $request->image->move(public_path($folder), $fileName);
        }

        Team::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'status' => $request->status,
            'team_type' => $request->team_type,
            'image' => $fileName,
            // 'joined_at' => $request->joined_at,
        ]);

        return redirect()->back()->with('success', 'Team member added successfully!');
    }

    // ✏️ Update team member
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'status' => 'required|in:active,inactive',
            'team_type' => 'required|in:our_team,volunteers,advisor',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:20480',
            // 'joined_at' => 'required|date',
        ]);

        $member = Team::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old file
            $oldFolder = ($member->team_type == 'advisor') ? 'uploads/team/pdfs' : 'uploads/team';
            $oldPath = public_path($oldFolder . '/' . $member->image);
            if (File::exists($oldPath)) File::delete($oldPath);

            // Move new file
            $extension = $request->image->extension();
            $fileName = time() . '.' . $extension;
            $folder = ($request->team_type == 'advisor') ? 'uploads/team/pdfs' : 'uploads/team';
            $request->image->move(public_path($folder), $fileName);
            $member->image = $fileName;
        }

        // Update other fields
        $member->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'status' => $request->status,
            'team_type' => $request->team_type,
            // 'joined_at' => $request->joined_at,
        ]);

        return redirect()->back()->with('success', 'Team member updated successfully!');
    }

    // 🗑 Delete team member
    public function destroy($id)
    {
        $member = Team::findOrFail($id);

        // Delete file
        $folder = ($member->team_type == 'advisor') ? 'uploads/team/pdfs' : 'uploads/team';
        $filePath = public_path($folder . '/' . $member->image);
        if (File::exists($filePath)) File::delete($filePath);

        $member->delete();

        return redirect()->back()->with('success', 'Team member deleted successfully!');
    }
}


// namespace App\Http\Controllers\Admin\ContentManagement;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\admin\contentmanagment\Team;
// use Illuminate\Support\Facades\File;

// class TeamController extends Controller
// {
//     // ðŸ“Œ Show all team members
//     public function index()
//     {
//         $members = Team::latest('joined_at')->get();
//         return view('admin.team.index', compact('members'));
//     }

//     // ðŸ“Œ Store new team member
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string',
//             'designation' => 'required|string',
//             'status' => 'required|in:active,inactive',
//             'team_type' => 'required|in:our_team,volunteers,advisor',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
//             // 'joined_at' => 'required|date',
//         ]);

//         $imageName = null;

//         if ($request->hasFile('image')) {
//             $imageName = time() . '.' . $request->image->extension();
//             $request->image->move(public_path('uploads/team'), $imageName);
//         }

//         Team::create([
//             'name' => $request->name,
//             'designation' => $request->designation,
//             'status' => $request->status,
//             // 'joined_at' => $request->joined_at,
//             'image' => $imageName,
//         ]);

//         return redirect()->back()->with('success', 'Team member added successfully!');
//     }

//     // ðŸ“Œ Update team member
//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required|string',
//             'designation' => 'required|string',
//             'status' => 'required|in:active,inactive',
//             'team_type' => 'required|in:our_team,volunteers,advisor',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
//             // 'joined_at' => 'required|date',
//         ]);

//         $member = Team::findOrFail($id);

//         // Update image if uploaded
//         if ($request->hasFile('image')) {
//             // Delete old image
//             $oldImage = public_path('uploads/team/' . $member->image);
//             if (File::exists($oldImage)) {
//                 File::delete($oldImage);
//             }

//             $imageName = time() . '.' . $request->image->extension();
//             $request->image->move(public_path('uploads/team'), $imageName);
//             $member->image = $imageName;
//         }

//         // Update fields
//         $member->update([
//             'name' => $request->name,
//             'designation' => $request->designation,
//             'status' => $request->status,
//             // 'joined_at' => $request->joined_at,
//         ]);

//         return redirect()->back()->with('success', 'Team member updated successfully!');
//     }

//     // ðŸ“Œ Delete team member
//     public function destroy($id)
//     {
//         $member = Team::findOrFail($id);

//         // Delete image file
//         $imagePath = public_path('uploads/team/' . $member->image);
//         if (File::exists($imagePath)) {
//             File::delete($imagePath);
//         }

//         $member->delete();

//         return redirect()->back()->with('success', 'Team member deleted successfully!');
//     }
// }
