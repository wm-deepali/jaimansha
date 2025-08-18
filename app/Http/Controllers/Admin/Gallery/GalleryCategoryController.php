<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\gallery\Category;

class GalleryCategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.gallery.categories.index', compact('categories'));
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gallery.categories.index')->with('success', 'Category added successfully.');
    }

    // Edit form data (API or modal)
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    // Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gallery.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.gallery.categories.index')->with('success', 'Category deleted successfully.');
    }
}
