<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\contentmanagment\LegalPanel;

class LegalController extends Controller
{
    // 📌 Show all legal documents
    public function index()
    {
        $documents = LegalPanel::latest()->get();
        return view('admin.legal.index', compact('documents'));
    }

    // 📌 Store a new legal document
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'short_info' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:20480',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->only(['title', 'short_info', 'status','image']);

      if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('uploads/legal'), $imageName);
    $data['image'] = $imageName;
}


        LegalPanel::create($data);

        return redirect()->back()->with('success', 'Legal document added successfully!');
    }

    // 📌 Show specific document (optional)
    public function show($id)
    {
        $doc = LegalPanel::findOrFail($id);
        return response()->json($doc);
    }

    // 📌 Update existing document
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'short_info' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:20480',
            'status' => 'required|in:active,inactive'
        ]);

        $doc = LegalPanel::findOrFail($id);
        $data = $request->only(['title', 'short_info', 'status','image']);

      if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('uploads/legal'), $imageName);
    $data['image'] = $imageName;
}


        $doc->update($data);

        return redirect()->back()->with('success', 'Legal document updated successfully!');
    }

    // 📌 Delete document
    public function destroy($id)
    {
        $doc = LegalPanel::findOrFail($id);
        $doc->delete();

        return redirect()->back()->with('success', 'Legal document deleted!');
    }
}
