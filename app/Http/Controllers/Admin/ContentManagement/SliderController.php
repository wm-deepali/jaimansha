<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\SliderSettings;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    // 📌 Show all sliders
    public function index()
    {
        $sliders = SliderSettings::orderBy('id', 'desc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    // 📌 Store new slider
    public function store(Request $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = 'slider_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('adminpannel/uploads/sliders'), $imageName);
        }

        SliderSettings::create([
    'subtitle'             => $request->subtitle ?? '',
    'title'                => $request->title ?? '',
    'fixed_title'          => $request->fixed_title ?? '',
    'fixed_color_title'    => $request->fixed_color_title ?? '',
    'animation_text'       => $request->animation_text ?? '',
    'button_text'          => $request->button_text ?? '',
    'image'                => $imageName,
    'video_url'            => $request->video_url ?? '',
    'status'               => $request->status ?? 'inactive',
]

);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider added successfully.');
    }

    // 📌 Edit slider
    public function edit($id)
    {
        $editData = SliderSettings::findOrFail($id);
        $sliders = SliderSettings::orderBy('id', 'desc')->get();
        return view('admin.sliders.index', compact('editData', 'sliders'));
    }

    // 📌 Update slider
    public function update(Request $request, $id)
    {
        $slider = SliderSettings::findOrFail($id);
        $imageName = $slider->image;

        // ✅ If new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            $oldPath = public_path('adminpannel/uploads/sliders/' . $slider->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('image');
            $imageName = 'slider_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('adminpannel/uploads/sliders'), $imageName);
        }

        $slider->update([
    'subtitle'             => $request->subtitle ?? '',
    'title'                => $request->title ?? '',
    'fixed_title'          => $request->fixed_title ?? '',
    'fixed_color_title'    => $request->fixed_color_title ?? '',
    'animation_text'       => $request->animation_text ?? '',
    'button_text'          => $request->button_text ?? '',
    'image'                => $imageName,
    'video_url'            => $request->video_url ?? '',
    'status'               => $request->status ?? 'inactive',
]

);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    // 📌 Delete slider
    public function destroy($id)
    {
        $slider = SliderSettings::findOrFail($id);

        // ✅ Delete image file
        if ($slider->image) {
            $imagePath = public_path('adminpannel/uploads/sliders/' . $slider->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
