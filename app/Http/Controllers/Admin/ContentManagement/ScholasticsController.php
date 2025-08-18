<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Scholastic;

class ScholasticsController extends Controller
{   // 📌 List All Scholastics
    public function index()
    {
        $scholastics = Scholastic::all();
        return view('admin.scholastics.index', compact('scholastics'));
    }

    // 📌 Show Create Form
    public function create()
    {
        return view('admin.scholastics.create');
    }

    // 📌 Store Scholastic
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        Scholastic::create($request->all());

        return redirect()->route('admin.scholastics.index')->with('success', 'Scholastic added successfully.');
    }

    // 📌 Show Edit Form
    public function edit($id)
    {
        $scholastic = Scholastic::findOrFail($id);
        return view('admin.contentmanagment.scholastics.edit', compact('scholastic'));
    }

    // 📌 Update Scholastic
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $scholastic = Scholastic::findOrFail($id);
        $scholastic->update($request->all());

        return redirect()->route('admin.scholastics.index')->with('success', 'Scholastic updated successfully.');
    }

    // 📌 Delete Scholastic
    public function destroy($id)
    {
        $scholastic = Scholastic::findOrFail($id);
        $scholastic->delete();

        return redirect()->back()->with('success', 'Scholastic deleted successfully.');
    }

    // 📌 Toggle Status (Active/Inactive)
    public function toggleStatus($id)
    {
        $scholastic = Scholastic::findOrFail($id);
        $scholastic->status = $scholastic->status === 'active' ? 'inactive' : 'active';
        $scholastic->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
