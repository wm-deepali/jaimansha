<?php

namespace App\Http\Controllers\Admin\Program;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Program\ProgramModel;

class ProgramController extends Controller
{
    // Show all programs
    public function index()
    {
        $programs = ProgramModel::all();
        return view('admin.program.index', compact('programs'));
    }

    // Show form to create new program
    public function create()
    {
        return view('admin.program.create');
    }

    // Store new program
public function store(Request $request)
{
    $data = new ProgramModel();

    $data->title       = $request->title;
    $data->text_1      = $request->text_1;
    $data->text_2      = $request->text_2;

    // Convert points from textarea to array
    $pointsArray = preg_split("/\r\n|\n|\r|,/", $request->points);
$data->points = json_encode(array_map('trim', $pointsArray));

    $data->video_url   = $request->video_url;
    $data->text_3      = $request->text_3;

    // tabs should already be JSON (from JS), so no need to encode
    $data->tabs        = $request->tabs;

    $data->slug        = $request->slug;
    $data->status      = $request->status ?? 'Inactive';
   $data->added_date = $request->added_date ?? now();

    if ($request->hasFile('video_image')) {
        $image = $request->file('video_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/programs'), $imageName);
        $data->video_image = $imageName;
    }

    $data->save();

    return redirect()->route('admin.program.index')->with('success', 'Program added successfully.');
}


    // Show form to edit program
    public function edit($id)
    {
        $program = ProgramModel::findOrFail($id);
        return view('admin.program.edit', compact('program'));
    }

    // Update program
public function update(Request $request, $id)
{
    $data = ProgramModel::findOrFail($id);

    $data->title       = $request->title;
    $data->text_1      = $request->text_1;
    $data->text_2      = $request->text_2;

    // Convert points from textarea to array
$pointsArray = preg_split("/\r\n|\n|\r|,/", $request->points);
$data->points = json_encode(array_map('trim', $pointsArray));

    $data->video_url   = $request->video_url;
    $data->text_3      = $request->text_3;

    // tabs should already be JSON (from JS), so no need to encode
    $data->tabs        = $request->tabs;

    $data->slug        = $request->slug;
    $data->status      = $request->status ?? 'Inactive';

    if ($request->hasFile('video_image')) {
        // Delete old image if exists
        if ($data->video_image && file_exists(public_path('uploads/programs/' . $data->video_image))) {
            unlink(public_path('uploads/programs/' . $data->video_image));
        }

        $image = $request->file('video_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/programs'), $imageName);
        $data->video_image = $imageName;
    }

    $data->save();

    return redirect()->route('admin.program.index')->with('success', 'Program updated successfully.');
}


    // Delete program
    public function destroy($id)
    {
        $data = ProgramModel::findOrFail($id);

        if ($data->video_image && file_exists(public_path('uploads/programs/' . $data->video_image))) {
            unlink(public_path('uploads/programs/' . $data->video_image));
        }

        $data->delete();

        return redirect()->route('admin.program.index')->with('success', 'Program deleted successfully.');
    }
}
