<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\donations\Donor;

class DonateusController extends Controller
{
    // Show all donors
    public function index()
    {
        $donors = Donor::latest()->get();
        return view('frontend.donate_us.index', compact('donors'));
    }

    // Show form to create a donor
    public function create()
    {
        return view('frontend.donate_us.create');
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'donation_for' => 'required|string',
        'amount' => 'required|numeric|min:1',
        'first_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        'email' => 'required|email',
        'address' => 'required|string',
        'country' => 'required|string',
        'state' => 'required|string',
        'city' => 'required|string',
        'pincode' => 'required|string|max:10',
    ]);

    // Save data
    Donor::create([
        'full_name' => $validated['first_name'],
        'email' => $validated['email'],
        'phone' => $validated['mobile'],
        'address' => $validated['address'],
        'city' => $validated['city'],
        'state' => $validated['state'],
        'country' => $validated['country'],
        'zip_code' => $validated['pincode'],
        'donor_type' => $validated['donation_for'],
        'amount' => $validated['amount'], // ✅ Added amount here
    ]);

   return redirect()->back()->with('success', 'Donation form is filled');;
}



    // Show edit form
    public function edit($id)
    {
        $donor = Donor::findOrFail($id);
        return view('frontend.donate_us.edit', compact('donor'));
    }

    // Update donor (without validation for now)
    public function update(Request $request, $id)
    {
        $donor = Donor::findOrFail($id);
        $donor->update($request->all());
        return redirect()->route('donate.index')->with('success', 'Donor updated successfully.');
    }

    // Delete donor
    public function destroy($id)
    {
        $donor = Donor::findOrFail($id);
        $donor->delete();
        return redirect()->route('donate.index')->with('success', 'Donor deleted successfully.');
    }
}
