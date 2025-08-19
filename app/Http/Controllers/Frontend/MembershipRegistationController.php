<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\MembershipRegistation;
use App\Models\admin\membership\Package;
use Carbon\Carbon;

class MembershipRegistationController extends Controller
{
    // Show the membership registration form
    public function index()
    {
        $packages = Package::all();
        return view('frontend.membership_registration.index', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:manage_packages,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'mobile' => 'required|string|max:15',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pin_code' => 'required|string|max:10',
            'content' => 'nullable|string',
        ]);

        $package = Package::find($request->package_id);
        // dd($request->all());


        $countryName = \App\Models\Country::find($request->country)?->name ?? '';
        $stateName = \App\Models\State::find($request->state)?->name ?? '';
        $cityName = \App\Models\City::find($request->city)?->name ?? '';



        MembershipRegistation::create([
            'membership_type' => $package->package_name,
            'package_id' => $request->package_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'city' => $cityName,
            'state' => $stateName,
            'country' => $countryName,
            'pin_code' => $request->pin_code,
            // 'content'         => $request->content,
        ]);

        return redirect()->back()->with('success', 'Membership registration successful!');
    }

}
