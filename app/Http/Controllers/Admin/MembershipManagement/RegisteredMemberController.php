<?php

namespace App\Http\Controllers\Admin\MembershipManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\membership\RegisteredMember;

class RegisteredMemberController extends Controller
{
    public function index()
    {
        $members = RegisteredMember::latest()->get();
        return view('admin.membership.registered.index', compact('members'));
    }
    // Show create form
    public function create()
    {
        return view('admin.membership.registered.create');
    }

    // Store membership
    public function store(Request $request)
    {
        $request->validate([
            'membership_type' => 'required',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        // Set amount based on membership type
        $amount = match ($request->membership_type) {
            'Associative Membership' => 1001,
            'Lifetime Membership' => 10000,
            'Lifetime Institutional Membership' => 2000,
            'Student Membership' => 0,
            default => 0,
        };

        $data = $request->all();
        $data['amount'] = $amount;

        RegisteredMember::create($data);

        return redirect()->route('admin.membership.registered.index')->with('success', 'Membership created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $member = RegisteredMember::findOrFail($id);
        return view('admin.membership.registered.edit', compact('member'));
    }

    // Update membership
    public function update(Request $request, $id)
    {
        $member =  RegisteredMember::findOrFail($id);

        $member->membership_type = $request->membership_type;
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->email = $request->email;
        $member->mobile = $request->mobile;
        $member->gender = $request->gender;
        $member->date_of_birth = $request->date_of_birth;
        $member->address = $request->address;
        $member->country = $request->country;
        $member->state = $request->state;
        $member->city = $request->city;
        $member->pin_code = $request->pin_code;

        $member->save();

        return redirect()->back()->with('success', 'Member updated successfully.');
    }


    // Delete membership
    public function destroy($id)
    {
        $member = RegisteredMember::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.membership.registered.index')->with('success', 'Membership deleted successfully.');
    }

    // Show single membership detail (optional)
    public function show($id)
    {
        return view('admin.membership.registered.show', compact('member'));
    }
}
