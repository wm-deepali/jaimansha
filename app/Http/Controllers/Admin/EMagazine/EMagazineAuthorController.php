<?php

namespace App\Http\Controllers\Admin\EMagazine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\emagazine\Author;

class EMagazineAuthorController extends Controller
{
    // Show all authors
    public function index()
    {
        $authors = Author::latest()->get();
        return view('admin.emagazine.authors.index', compact('authors'));
    }

    // Show form to create a new author
    public function create()
    {
        return view('admin.emagazine.authors.create');
    }

    // Store a new author
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
        // ... other validations
    ]);

    $author = new Author();
    $author->name = $request->name;
    $author->father_name = $request->father_name;
$author->email = $request->email;
    $author->mobile_number = $request->mobile_number;
    $author->whatsapp_number = $request->whatsapp_number;
    $author->address = $request->address;
    $author->country = $request->country;
    $author->state = $request->state;
    $author->city = $request->city;
    $author->pin_code = $request->pin_code;
    $author->facebook = $request->facebook;
    $author->twitter = $request->twitter;
    $author->linkedin = $request->linkedin;
    $author->youtube = $request->youtube;
    $author->author_type = $request->author_type;
    $author->registered_by = $request->registered_by ?? 'admin';
    $author->status = $request->status ?? 1;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/authors'), $imageName);
        $author->image = $imageName;
    }

    $author->save();

    return redirect()->back()->with('success', 'Author added successfully');
}


    // Show form to edit an author
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.emagazine.authors.edit', compact('author'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
        // ... other validations can go here
    ]);

    $author = Author::findOrFail($id);

    $author->name = $request->name;
    $author->father_name = $request->father_name;
$author->email = $request->email;
    $author->mobile_number = $request->mobile_number;
    $author->whatsapp_number = $request->whatsapp_number;
    $author->address = $request->address;
    $author->country = $request->country;
    $author->state = $request->state;
    $author->city = $request->city;
    $author->pin_code = $request->pin_code;
    $author->facebook = $request->facebook;
    $author->twitter = $request->twitter;
    $author->linkedin = $request->linkedin;
    $author->youtube = $request->youtube;
    $author->author_type = $request->author_type;
    $author->registered_by = $request->registered_by ?? $author->registered_by;
    $author->status = $request->status ?? $author->status;

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($author->image && file_exists(public_path('uploads/authors/' . $author->image))) {
            unlink(public_path('uploads/authors/' . $author->image));
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/authors'), $imageName);
        $author->image = $imageName;
    }

    $author->save();

    return redirect()->route('admin.emagazine.authors.index')->with('success', 'Author updated successfully.');
}


    // Delete an author
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('admin.emagazine.authors.index')->with('success', 'Author deleted successfully.');
    }
}
