<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Sponsorship;
use App\Models\admin\contentmanagment\SponsorshipRegistration;

class SponshorshipController extends Controller
{
    public function index()
    {
        $sponshorship = Sponsorship::first();
        return view('frontend.sponsorship.index', compact('sponshorship'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sponsorship_type' => 'required|string',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'detail' => 'nullable|string|max:1000',
        ]);

        $countryName = \App\Models\Country::find($request->country)?->name ?? '';
        $stateName = \App\Models\State::find($request->state)?->name ?? '';
        $cityName = \App\Models\City::find($request->city)?->name ?? '';


        SponsorshipRegistration::create([
            'sponsorship_type' => $request->sponsorship_type,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'city' => $cityName,
            'state' => $stateName,
            'country' => $countryName,
            'pincode' => $request->pincode,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('success', 'Thank you for your sponsorship submission!');
    }
}
