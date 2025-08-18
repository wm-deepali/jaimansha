<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\DonateUs;
use Illuminate\Support\Str;

class DonatePageController extends Controller
{
    // Show all donate content
    public function index()
    {
        $donates = DonateUs::all();
        return view('admin.donate.index', compact('donates'));
    }

    // Store new donate content
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|alpha_dash|unique:donate_contents,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',  // limit image size optional
            'status' => 'required|in:active,inactive',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->only([
            'title',
            'description',
            'status',
            'slug',
            'meta_description',
            'meta_keywords',
        ]);

        // If slug is empty or whitespace, generate from title (redundant here as slug required, but safe)
        if (empty(trim($data['slug']))) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/donate'), $filename);
            $data['image'] = $filename;
        }

        DonateUs::create($data);

        return redirect()->back()->with('success', 'Donate content added successfully!');
    }

    // Update existing donate content
    public function update(Request $request, $id)
    {
        $donate = DonateUs::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            // Unique slug except current record
            'slug' => 'required|alpha_dash|unique:donate_contents,slug,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'status' => 'required|in:active,inactive',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->only([
            'title',
            'description',
            'status',
            'slug',
            'meta_description',
            'meta_keywords',
        ]);

        if (empty(trim($data['slug']))) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image file if exists
            if ($donate->image && file_exists(public_path('uploads/donate/' . $donate->image))) {
                @unlink(public_path('uploads/donate/' . $donate->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/donate'), $filename);
            $data['image'] = $filename;
        }

        $donate->update($data);

        return redirect()->back()->with('success', 'Donate content updated successfully!');
    }

    // Delete donate content
    public function destroy($id)
    {
        $donate = DonateUs::findOrFail($id);

        // Delete old image if exists
        if ($donate->image && file_exists(public_path('uploads/donate/' . $donate->image))) {
            @unlink(public_path('uploads/donate/' . $donate->image));
        }

        $donate->delete();

        return redirect()->back()->with('success', 'Donate content deleted successfully!');
    }

    // Optional: Toggle status between active/inactive
    public function toggleStatus($id)
    {
        $donate = DonateUs::findOrFail($id);
        $donate->status = ($donate->status === 'active') ? 'inactive' : 'active';
        $donate->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
