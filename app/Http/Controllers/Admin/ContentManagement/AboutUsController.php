<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\AboutUs;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = AboutUs::all();
        return view('admin.aboutus.index', compact('data'));
    }

    public function create()
    {
        return view('admin.aboutus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading_1' => 'required',
            'heading_2' => 'nullable',
            'Description' => 'nullable',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $data = $request->only(['heading_1', 'heading_2', 'Description','image_1','image_2']);

        if ($request->hasFile('image_1')) {
            $imageName1 = time() . '_img1.' . $request->image_1->extension();
            $request->image_1->move(public_path('adminpannel/uploads/aboutus'), $imageName1);
            $data['image_1'] = 'adminpannel/uploads/aboutus/' . $imageName1;
        }

        if ($request->hasFile('image_2')) {
            $imageName2 = time() . '_img2.' . $request->image_2->extension();
            $request->image_2->move(public_path('adminpannel/uploads/aboutus'), $imageName2);
            $data['image_2'] = 'adminpannel/uploads/aboutus/' . $imageName2;
        }

        AboutUs::create($data);
        return redirect()->route('admin.aboutus.index')->with('success', 'Record added successfully');
    }

    public function edit($id)
    {
        $data = AboutUs::findOrFail($id);
        return view('admin.aboutus.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $about = AboutUs::findOrFail($id);

        $request->validate([
            'heading_1' => 'required',
            'heading_2' => 'nullable',
            'Description' => 'nullable',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $data = $request->only(['heading_1', 'heading_2', 'Description','image_1','image_2']);

        if ($request->hasFile('image_1')) {
            if ($about->image_1 && File::exists(public_path($about->image_1))) {
                File::delete(public_path($about->image_1));
            }

            $imageName1 = time() . '_img1.' . $request->image_1->extension();
            $request->image_1->move(public_path('adminpannel/uploads/aboutus'), $imageName1);
            $data['image_1'] = 'adminpannel/uploads/aboutus/' . $imageName1;
        }

        if ($request->hasFile('image_2')) {
            if ($about->image_2 && File::exists(public_path($about->image_2))) {
                File::delete(public_path($about->image_2));
            }

            $imageName2 = time() . '_img2.' . $request->image_2->extension();
            $request->image_2->move(public_path('adminpannel/uploads/aboutus'), $imageName2);
            $data['image_2'] = 'adminpannel/uploads/aboutus/' . $imageName2;
        }

        $about->update($data);
        return redirect()->route('admin.aboutus.index')->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);

        if ($about->image_1 && File::exists(public_path($about->image_1))) {
            File::delete(public_path($about->image_1));
        }

        if ($about->image_2 && File::exists(public_path($about->image_2))) {
            File::delete(public_path($about->image_2));
        }

        $about->delete();
        return redirect()->route('admin.aboutus.index')->with('success', 'Record deleted successfully');
    }
}
