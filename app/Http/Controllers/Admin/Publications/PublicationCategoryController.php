<?php

namespace App\Http\Controllers\Admin\Publications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\publications\Category as MagazineCategory;
use App\Models\admin\publications\Author;
use Illuminate\Support\Str;

class PublicationCategoryController extends Controller
{
       public function index()
{
    $categories = MagazineCategory::with('author')->orderBy('id', 'desc')->get();
    $authors = Author::whereIn('author_type', ['magazine', 'both'])->get();

    return view('admin.publications.categories.index', compact('categories', 'authors'));
}

    // Show create form
    public function create()
    {
        $authors = Author::where('author_type', 'magazine')->get(); // Filter authors for magazine
        return view('admin.publications.categories.create', compact('authors'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        MagazineCategory::create([
            'author_id' => $request->author_id,
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return redirect()->route('admin.publications.categories.index')->with('success', 'Category added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $category = MagazineCategory::findOrFail($id);
        $authors = Author::where('author_type', 'magazine')->get();
        return view('admin.publications.categories.edit', compact('category', 'authors'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $category = MagazineCategory::findOrFail($id);

        $category->update([
            'author_id' => $request->author_id,
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return redirect()->route('admin.publications.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy($id)
    {
        $category = MagazineCategory::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
