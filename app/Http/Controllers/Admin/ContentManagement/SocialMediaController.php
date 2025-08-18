<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\SocialMedia;
use App\Models\admin\contentmanagment\HeaderInformation;

class SocialMediaController extends Controller
{
    public function view()
    {
        $social = SocialMedia::first(); // assuming only one row
        if (!$social) {
            $social = new SocialMedia(); // empty model to avoid errors in view
        }
        return view('admin.socialmedia.view', compact('social'));
    }



public function update(Request $request)
{
    $social = SocialMedia::find(2);

    if (!$social) {
        $social = new SocialMedia();
        $social->id = 2;

        // HeaderInformation se default values lo
        $header = HeaderInformation::first();
        if ($header) {
            $social->logo = $header->logo;
            $social->mobileNumber = $header->mobileNumber;
            $social->helplineNumber = $header->helplineNumber;
            $social->email = $header->email;
            $social->added_date = $header->added_date;
        }
    }

    // Update social media links from request
    $social->facebook = $request->facebook;
    $social->twitter = $request->twitter;
    $social->linkedin = $request->linkedin;
    $social->youtube = $request->youtube;
    $social->pintreset = $request->pintreset;
    $social->instagram = $request->instagram;
    $social->gplus = $request->gplus;

    $social->save();

    return back()->with('success', 'Social Media links updated successfully!');
}

}
