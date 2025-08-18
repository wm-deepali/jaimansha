<?php

namespace App\Http\Controllers\Admin\Donations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\donations\Donor;

class DonationDonorController extends Controller
{
    // Show all donors
    public function index()
    {
        $donors = Donor::latest()->get();
        return view('admin.donations.donors.index', compact('donors'));
    }

    // Show form to create a new donor
    public function create()
    {
        return view('admin.donations.donors.create');
    }

    // Store new donor
public function store(Request $request)
{
    $request->validate([
        'full_name'         => 'required|string|max:255',
        'email'             => 'nullable|email|max:150',
        'phone'             => 'nullable|string|max:20',
        'address'           => 'nullable|string',
        'city'              => 'nullable|string|max:100',
        'state'             => 'nullable|string|max:100',
        'country'           => 'nullable|string|max:100',
        'zip_code'          => 'nullable|string|max:20',
        'donor_type'        => 'required|in:individual,organization',
        'organization_name' => 'nullable|string|max:255',
    ]);

    Donor::create([
        'full_name'         => $request->full_name,
        'email'             => $request->email,
        'phone'             => $request->phone,
        'address'           => $request->address,
        'city'              => $request->city,
        'state'             => $request->state,
        'country'           => $request->country,
        'zip_code'          => $request->zip_code,
        'donor_type'        => $request->donor_type,
        'organization_name' => $request->organization_name,
    ]);

    return redirect()->route('admin.donations.donors.index')->with('success', 'Donor added successfully.');
}


    // Show edit form
    public function edit($id)
    {
        $donor = Donor::findOrFail($id);
        return view('admin.donations.donors.edit', compact('donor'));
    }

// Update donor
public function update(Request $request, $id)
{
    $request->validate([
        'full_name'         => 'required|string|max:255',
        'email'             => 'nullable|email|max:150',
        'phone'             => 'nullable|string|max:20',
        'address'           => 'nullable|string',
        'city'              => 'nullable|string|max:100',
        'state'             => 'nullable|string|max:100',
        'country'           => 'nullable|string|max:100',
        'zip_code'          => 'nullable|string|max:20',
        'donor_type'        => 'required|in:individual,organization',
        'organization_name' => 'nullable|string|max:255',
    ]);

    $donor = Donor::findOrFail($id);

    $donor->update([
        'full_name'         => $request->full_name,
        'email'             => $request->email,
        'phone'             => $request->phone,
        'address'           => $request->address,
        'city'              => $request->city,
        'state'             => $request->state,
        'country'           => $request->country,
        'zip_code'          => $request->zip_code,
        'donor_type'        => $request->donor_type,
        'organization_name' => $request->organization_name,
    ]);

    return redirect()->route('admin.donations.donors.index')->with('success', 'Donor updated successfully.');
}


    // Delete donor
    public function destroy($id)
    {
        $donor = Donor::findOrFail($id);
        $donor->delete();

        return redirect()->route('admin.donations.donors.index')->with('success', 'Donor deleted successfully.');
    }
}
