<?php

namespace App\Http\Controllers\Admin\MembershipManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\membership\MembershipEnquiry;
use App\Models\admin\membership\Package as MembershipPackage;
use Illuminate\Support\Facades\Validator;

class MembershipEnquiryController extends Controller
{
    // List all membership enquiries
    public function index()
    {
        $enquiries = MembershipEnquiry::all();
        $packages = MembershipPackage::all();
        return view('admin.membership.enquiry.index', compact('enquiries', 'packages'));
    }

    // Store a new membership enquiry
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:manage_packages,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mobile' => 'required|string|max:15',
            'gender' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'pin_code' => 'nullable|string|max:10',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        MembershipEnquiry::create($request->all());

        return redirect()->route('admin.membership.index')
            ->with('success', 'Membership enquiry created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $member = MembershipEnquiry::findOrFail($id);
        $packages = MembershipPackage::all();
        return view('admin.membership.enquiry.edit', compact('member', 'packages'));
    }

    // Update membership enquiry
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:manage_packages,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mobile' => 'required|string|max:15',
            'gender' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'pin_code' => 'nullable|string|max:10',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $member = MembershipEnquiry::findOrFail($id);
        $member->update($request->all());

        return redirect()->route('admin.membership.index')
            ->with('success', 'Membership enquiry updated successfully.');
    }

    // Delete a membership enquiry
    public function destroy($id)
    {
        $member = MembershipEnquiry::findOrFail($id);
        $member->delete();

        return redirect()->back()
            ->with('success', 'Membership enquiry deleted successfully.');
    }

    // (Optional) Show details page
    public function show($id)
    {
        $member = MembershipEnquiry::findOrFail($id);
        return view('admin.membership.enquiry.show', compact('member'));
    }
}
