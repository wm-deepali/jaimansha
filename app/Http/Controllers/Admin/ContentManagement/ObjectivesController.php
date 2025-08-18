<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Objectives;
use Illuminate\Support\Carbon;

class ObjectivesController extends Controller
{
    // 1. Index - Show all objectives
    public function index()
    {
        $objectives = Objectives::orderBy('id', 'ASC')->get();
        return view('admin.objectives.index', compact('objectives'));
    }

    // 2. Store - Save a new objective
    public function store(Request $request)
    {
        $request->validate([
            'objective' => 'required|string|max:1000',
        ]);

        Objectives::create([
            'objective' => $request->objective,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Objective added successfully!');
    }

    // 3. Edit - Load a single objective into the edit view
    public function edit($id)
    {
        $objective = Objectives::findOrFail($id);
        // return view('admin.objectives.edit', compact('objective'));

    return redirect()->route('admin.objectives.index')->with('success', 'Objective updated successfully.');
    }

    // 4. Update - Handle the update form submission
  // app/Http/Controllers/Admin/ObjectiveController.php

public function update(Request $request, $id)
{
    $request->validate([
        'objective' => 'required|string|max:1000',
    ]);

    $objective = Objectives::findOrFail($id);
    $objective->objective = $request->objective;
    $objective->save();

    return redirect()->route('admin.objectives.index')->with('success', 'Objective updated successfully.');
}


    // 5. Delete - Delete a record
    public function destroy($id)
    {
        $objective = Objectives::findOrFail($id);
        $objective->delete();

        return redirect()->back()->with('success', 'Objective deleted successfully!');
    }
}
