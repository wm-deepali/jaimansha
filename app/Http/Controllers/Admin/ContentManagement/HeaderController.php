<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\HeaderInformation;

class HeaderController extends Controller
{
    public function index()
    {
        $headers = HeaderInformation::select(
            'id',
            'logo',
            'mobileNumber',
            'helplineNumber',
            'email',
            'facebook',
            'twitter',
            'linkedin',
            'youtube',
            'instagram',
            'added_date'
        )
        ->orderBy('id', 'ASC')
        ->get();

        return view('admin.content.header', compact('headers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobileNumber' => 'required',
            'helplineNumber' => 'required',
            'email' => 'required|email',
            'logo' => 'required|image',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $imageName = time() . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('uploads/header/'), $imageName);
            $logoPath = 'uploads/header/' . $imageName;
        }

        HeaderInformation::create([
            'mobileNumber' => $request->mobileNumber,
            'helplineNumber' => $request->helplineNumber,
            'email' => $request->email,
            'logo' => $logoPath,
            // 'facebook' => $request->facebook,
            // 'twitter' => $request->twitter,
            // 'linkedin' => $request->linkedin,
            // 'youtube' => $request->youtube,
            // 'instagram' => $request->instagram,
            // 'gplus' => $request->gplus ?? null,
            // 'pintreset' => $request->pintreset ?? null,
            'added_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Header info added successfully!');
    }

    public function edit($id)
    {
        $header = HeaderInformation::findOrFail($id);
        return view('admin.content.edit_header', compact('header'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mobileNumber' => 'required',
            'helplineNumber' => 'required',
            'email' => 'required|email',
            'logo' => 'nullable|image',
        ]);

        $header = HeaderInformation::findOrFail($id);

        if ($request->hasFile('logo')) {
            // Delete old logo file if exists
            if ($header->logo && file_exists(public_path($header->logo))) {
                unlink(public_path($header->logo));
            }

            $image = $request->file('logo');
            $imageName = time() . $image->getClientOriginalName();
            $image->move(public_path('uploads/header/'), $imageName);
            $header->logo = 'uploads/header/' . $imageName;
        }

        $header->mobileNumber = $request->mobileNumber;
        $header->helplineNumber = $request->helplineNumber;
        $header->email = $request->email;
        // $header->facebook = $request->facebook;
        // $header->twitter = $request->twitter;
        // $header->linkedin = $request->linkedin;
        // $header->youtube = $request->youtube;
        // $header->instagram = $request->instagram;
        // $header->gplus = $request->gplus ?? null;
        // $header->pintreset = $request->pintreset ?? null;

        $header->save();

        return redirect()->route('admin.header.index')->with('success', 'Header info updated successfully!');
    }

    public function destroy($id)
    {
        $header = HeaderInformation::findOrFail($id);

        if ($header->logo && file_exists(public_path($header->logo))) {
            unlink(public_path($header->logo));
        }

        $header->delete();

        return redirect()->back()->with('success', 'Header info deleted successfully!');
    }
}
