<?php

namespace App\Http\Controllers\Admin\popup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Popup;
use App\Models\PopupImage;

class PopupController extends Controller
{
    // Show popup details and images
    public function index()
    {
        // Assuming only one popup record exists; if none, create one
        $popup = Popup::first();
        if (!$popup) {
            $popup = Popup::create(['active' => false]);
        }

        // Load popup images
        $popup->load('images');
        return view('admin.popups.index', compact('popup'));
    }

    public function update(Request $request)
    {
        $popup = Popup::find($request->get('id'));
        $request->validate([
            'title' => 'nullable|string|max:255',
            'active' => 'sometimes|accepted',  // accepts 'on', '1', true, 'yes', etc.
            'images.*' => 'nullable|image|max:2048',
        ]);


        $popup->title = $request->input('title');
        $popup->active = $request->has('active');  // true if checkbox was checked, false otherwise
        $popup->save();


        if ($request->hasFile('images')) {
          
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/popups'), $filename);

                $popup->images()->create([
                    'image_path' => 'uploads/popups/' . $filename,
                ]);
                // dd($request->all(), $popup->toArray(),$request->hasFile('images'));
            }
        }

        return redirect()->back()->with('success', 'Popup updated successfully.');
    }

    public function deleteImage(PopupImage $image)
    {
        $imagePath = public_path($image->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
