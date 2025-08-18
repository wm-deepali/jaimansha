<?php

namespace App\Http\Controllers\Admin\ManageIntroduction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ManageIntroduction\IntroductionFeature;
use App\Models\admin\ManageIntroduction\Introduction;

class IntroductionFeatureController extends Controller
{
    // 📌 List all features
    public function index()
    {
        $features = IntroductionFeature::with('introduction')->latest()->get();
        return view('admin.manageintroduction.feature.index', compact('features'));
    }

    // 📌 Store new feature
    public function store(Request $request)
    {
        $request->validate([
            'introduction_id' => 'required|exists:introductions,id',
            'feature_title' => 'required|string|max:255',
            'feature_content' => 'nullable|string',
            'icon_file' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:20480',
        ]);

        $data = $request->only(['introduction_id', 'feature_title', 'feature_content']);

        if ($request->hasFile('icon_file')) {
            $filename = time() . '.' . $request->icon_file->extension();
            $request->icon_file->move(public_path('uploads/icons'), $filename);
            $data['icon'] = $filename;
        } else {
            $data['icon'] = $request->input('icon'); // class-based icon
        }

        IntroductionFeature::create($data);

        return redirect()->back()->with('success', 'Feature added successfully.');
    }

    // 📌 Edit form
    public function edit($id)
    {
        $feature = IntroductionFeature::findOrFail($id);
        $introductions = Introduction::all();
        return view('admin.manageintroduction.feature.edit', compact('feature', 'introductions'));
    }

    // 📌 Update feature
    public function update(Request $request, $id)
    {
        $feature = IntroductionFeature::findOrFail($id);

        $request->validate([
            'feature_title' => 'required|string|max:255',
            'feature_content' => 'nullable|string',
            'icon_file' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:20480',
        ]);

        $data = $request->only(['feature_title', 'feature_content']);

        if ($request->hasFile('icon_file')) {
            $filename = time() . '.' . $request->icon_file->extension();
            $request->icon_file->move(public_path('uploads/icons'), $filename);
            $data['icon'] = $filename;
        } else {
            $data['icon'] = $request->input('icon'); // class-based icon
        }

        $feature->update($data);

        return redirect()->back()->with('success', 'Feature updated successfully.');
    }

    // 📌 Delete feature
    public function destroy($id)
    {
        $feature = IntroductionFeature::findOrFail($id);
        $feature->delete();

        return redirect()->back()->with('success', 'Feature deleted successfully.');
    }
}
