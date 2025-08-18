<?php

namespace App\Http\Controllers\admin\Donations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\donations\DonationCategory;
use Illuminate\Support\Str;


class DonationCategoryController extends Controller
{
    public function index()
    {
        $categories = DonationCategory::all();
        return view('admin.donation-category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.donation-category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DonationCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.donation-category.index')->with('success', 'Category created!');
    }

    public function edit($id)
    {
        $category = DonationCategory::findOrFail($id);
        return view('admin.donation-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = DonationCategory::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.donation-category.index')->with('success', 'Category updated!');
    }

    public function destroy($id)
    {
        DonationCategory::destroy($id);
        return redirect()->back()->with('success', 'Category deleted!');
    }
}
