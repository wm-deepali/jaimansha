<?php

namespace App\Http\Controllers\Admin\ManageIntroduction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ManageIntroduction\Introduction;

class IntroductionController extends Controller
{
    public function index()
    {
        $introductions = Introduction::latest()->get();
        return view('admin.manageintroduction.introduction.index', compact('introductions'));
    }

    public function create()
    {
        return view('admin.manageintroduction.introduction.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'detail_content' => 'nullable|string',
        ]);

        Introduction::create($request->only('heading', 'detail_content'));

        return redirect()->route('admin.manageintroduction.introduction.index')->with('success', 'Introduction created successfully.');
    }

    public function edit($id)
    {
        $introduction = Introduction::findOrFail($id);
        return view('admin.manageintroduction.introduction.edit', compact('introduction'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'detail_content' => 'nullable|string',
        ]);

        $introduction = Introduction::findOrFail($id);
        $introduction->update($request->only('heading', 'detail_content'));

        return redirect()->route('admin.manageintroduction.introduction.index')->with('success', 'Introduction updated successfully.');
    }

    public function destroy($id)
    {
        $introduction = Introduction::findOrFail($id);
        $introduction->delete();

        return redirect()->route('admin.manageintroduction.introduction.index')->with('success', 'Introduction deleted successfully.');
    }
}
