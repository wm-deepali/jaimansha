<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\setting\ProfileSetting;
use Illuminate\Support\Facades\File;
use Pest\Plugins\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileSettingController extends Controller
{
    public function index()
    {
        $profiles = ProfileSetting::first();
        return view('admin.settings.profile', compact('profiles'));
    }
public function changePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'current_password' => 'required',
        'new_password' => 'required|min:5',
        'confirm_password' => 'required|same:new_password'
    ]);

    $id = session('admin_user');

    if (!$id) {
        session()->flash('error', 'Unauthenticated admin user.');
        return redirect()->back();
    }

    $admin = ProfileSetting::find($id);

    if (!$admin) {
        session()->flash('error', 'Admin user not found.');
        return redirect()->back();
    }

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // ✅ Password match check (sahi logic)
    if (!Hash::check($request->current_password, $admin->password)) {
        session()->flash('error', 'Your current password is incorrect.');
        return redirect()->back();
    }

    // ✅ Password update
    $admin->password = Hash::make($request->new_password);
    $admin->save();

    session()->flash('success', 'Password changed successfully.');
    return redirect()->back();
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email_id' => 'required|email',
            'contact_number' => 'nullable|string',
            'address' => 'nullable|string',
            'header_logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'login_logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $profile = new ProfileSetting();
        $profile->fill($validated);

        // Upload images
        $profile->header_logo = $this->uploadImage($request, 'header_logo');
        $profile->login_logo = $this->uploadImage($request, 'login_logo');
        $profile->profile_picture = $this->uploadImage($request, 'profile_picture');

        $profile->save();

        return redirect()->back()->with('success', 'Profile created successfully.');
    }

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'username'=> 'required',
        'email_id' => 'required|email',
        'contact_number' => 'nullable|string',
        'address' => 'nullable|string',
        'logo_header' => 'nullable|image|mimes:jpg,jpeg,png',
        'logo_login' => 'nullable|image|mimes:jpg,jpeg,png',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    // ✅ Profile get karo pehle
    $profile = ProfileSetting::findOrFail($id);

    // ✅ Basic validated fields assign karo
    $profile->fill($validated);

    // ✅ Images agar naye aaye ho toh upload karo
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $profile->profile_picture = $path;
    }

    if ($request->hasFile('logo_header')) {
        $path = $request->file('logo_header')->store('logos', 'public');
        $profile->logo_header = $path;
    }

    if ($request->hasFile('logo_login')) {
        $path = $request->file('logo_login')->store('logos', 'public');
        $profile->logo_login = $path;
    }

    $profile->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

    private function uploadImage(Request $request, $field, $oldPath = null)
    {
        if ($request->hasFile($field)) {
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }
            $file = $request->file($field);
            $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/profile/';
            $file->move(public_path($path), $filename);
            return $path . $filename;
        }
        return $oldPath;
    }
}
