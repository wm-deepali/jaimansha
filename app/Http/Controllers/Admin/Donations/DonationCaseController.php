<?php

namespace App\Http\Controllers\admin\Donations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\donations\DonationCase;
use App\Models\admin\donations\DonationCategory;

class DonationCaseController extends Controller
{
    public function index()
    {
        $cases = DonationCase::with('category')->get();
        $categories=DonationCategory::all();
        return view('admin.donation-cases.index', compact('cases','categories'));
    }

    public function create()
    {
        $categories = DonationCategory::where('status', 1)->get();
        return view('admin.donation-cases.create', compact('categories'));
    }

 public function store(Request $request)
{
    $request->validate([
    'title' => 'required|string|max:255',
    'category_id' => 'required|exists:donation_categories,id',
    'donation_required' => 'required|numeric',
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480', // 15MB
]);
    $imageName = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/donations'), $imageName);
    }

    DonationCase::create([
        'title' => $request->title,
        'short_description' => $request->short_description,
        'full_description' => $request->full_description,
        'image' => $imageName,
        'donation_required' => $request->donation_required,
        'donation_raised' => $request->donation_raised ?? 0,
        'target_days' => $request->target_days ?? 30,
        'supports_count' => $request->supports_count ?? 0,
        'category_id' => $request->category_id,
        'status' => $request->status ?? 1,
    ]);

    return redirect()->route('admin.donation-cases.index')->with('success', 'Donation case added!');
}

    public function edit($id)
    {
        $case = DonationCase::findOrFail($id);
        $categories = DonationCategory::where('status', 1)->get();
        return view('admin.donation-cases.edit', compact('case', 'categories'));
    }

 public function update(Request $request, $id)
{
    $case = DonationCase::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:donation_categories,id',
        'donation_required' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
    ]);

    $imageName = $case->image;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/donations'), $imageName);
    }

    $case->update([
        'title' => $request->title,
        'short_description' => $request->short_description,
        'full_description' => $request->full_description,
        'image' => $imageName,
        'donation_required' => $request->donation_required,
        'donation_raised' => $request->donation_raised,
        'target_days' => $request->target_days,
        'supports_count' => $request->supports_count,
        'category_id' => $request->category_id,
        'status' => $request->status ?? 1,
    ]);

    return redirect()->route('admin.donation-cases.index')->with('success', 'Donation case updated!');
}

    public function destroy($id)
    {
        DonationCase::destroy($id);
        return redirect()->back()->with('success', 'Case deleted!');
    }
}
