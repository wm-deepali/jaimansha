<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\SponsorshipRegistration;

class SponsorshipRegistationController extends Controller
{
    // Show all records (index)
    public function index()
    {
        $data = SponsorshipRegistration::all();
        return view('admin.sponsorship_registation.index', compact('data'));
    }

    // Show create form
    public function create()
    {
        return view('admin.sponsorship_registation.create');
    }

    // Store the submitted data
    public function store(Request $request)
    {
       $data = $request->validate([
    'sponsorship_type' => 'required|string',
    'full_name' => 'required|string',
    'email' => 'required|email',
    'mobile' => 'required|string',
    'company_name' => 'nullable|string',
    'address' => 'nullable|string',
    'country' => 'required|string',
    'state' => 'required|string',
    'city' => 'required|string',
    'pincode' => 'required|string',
    'detail' => 'nullable|string',
]);

    SponsorshipRegistration::create($data);

        return redirect()->route('admin.sponsorship_registation.index')->with('success', 'Sponsorship Registered Successfully!');
    }

    // Show a single record
    public function show($id)
    {
        $sponsorship = SponsorshipRegistration::findOrFail($id);
        return view('admin.sponsorship_registation.show', compact('sponsorship'));
    }

    // Show edit form
    public function edit($id)
    {
        $sponsorship = SponsorshipRegistration::findOrFail($id);
        return view('admin.sponsorship_registation.edit', compact('sponsorship'));
    }

    // Update the record
    public function update(Request $request, $id)
    {
        $sponsorship = SponsorshipRegistration::findOrFail($id);

        $request->validate([
            'sponsorship_type' => 'required|in:event,education,scholarship',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:15',
            'company_name' => 'nullable|string|max:255',
            'address' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'detail' => 'nullable|string|max:1000',
        ]);

        $sponsorship->update($request->all());

        return redirect()->route('admin.sponsorship_registation.index')->with('success', 'Sponsorship Updated Successfully!');
    }

    // Delete the record
    public function destroy($id)
    {
        $sponsorship = SponsorshipRegistration::findOrFail($id);
        $sponsorship->delete();

        return redirect()->route('admin.sponsorship_registation.index')->with('success', 'Sponsorship Deleted Successfully!');
    }
}
