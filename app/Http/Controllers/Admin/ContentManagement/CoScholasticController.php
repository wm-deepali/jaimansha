<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\CoScholastic;

class CoScholasticController extends Controller
{
    public function index()
    {
        $scholastics = CoScholastic::all();
        return view('admin.co_scholastics.index', compact('scholastics'));
    }

    // 📌 Show Create Form
    public function create()
    {
        return view('admin.co_scholastics.create');
    }

    // 📌 Store Scholastic
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

       CoScholastic::create($request->all());

        return redirect()->route('admin.co_scholastics.index')->with('success', 'Scholastic added successfully.');
    }

    // 📌 Show Edit Form
    public function edit($id)
    {
        $scholastic = CoScholastic::findOrFail($id);
        return view('admin.co_scholastics.edit', compact('scholastic'));
    }

    // 📌 Update Scholastic
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $scholastic = CoScholastic::findOrFail($id);
        $scholastic->update($request->all());

        return redirect()->route('admin.co_scholastics.index')->with('success', 'Scholastic updated successfully.');
    }

    // 📌 Delete Scholastic
    public function destroy($id)
    {
        $scholastic = CoScholastic::findOrFail($id);
        $scholastic->delete();

        return redirect()->back()->with('success', 'Scholastic deleted successfully.');
    }

    // 📌 Toggle Status (Active/Inactive)
    public function toggleStatus($id)
    {
        $scholastic = CoScholastic::findOrFail($id);
        $scholastic->status = $scholastic->status === 'active' ? 'inactive' : 'active';
        $scholastic->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
