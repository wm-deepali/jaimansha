<?php

namespace App\Http\Controllers\Admin\MembershipManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\membership\MemberNotification;
use App\Models\admin\membership\MembershipPage;

class MemberNotificationController extends Controller
{
    public function index()
    {
        $memberships = MemberNotification::with('membership')->latest()->get();
        $membershipTypes = MembershipPage::all();
        return view('admin.notifications.index', compact('memberships', 'membershipTypes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'membership_id' => 'required|exists:memberships,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        MemberNotification::create($request->all());

        return redirect()->back()->with('success', 'Notification added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'membership_id' => 'required|exists:memberships,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $notification = MemberNotification::findOrFail($id);
        $notification->update($request->all());

        return redirect()->back()->with('success', 'Notification updated successfully.');
    }

    public function destroy($id)
    {
        $notification = MemberNotification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
