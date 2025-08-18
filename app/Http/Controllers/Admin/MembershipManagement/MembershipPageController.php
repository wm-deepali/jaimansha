<?php

namespace App\Http\Controllers\Admin\MembershipManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\membership\MembershipPage;

class MembershipPageController extends Controller
{
    // Show content (assuming single row — static content page)
    public function index()
    {
        $contents = MembershipPage::all(); // We assume only 1 row
        return view('admin.membership.index', compact('contents'));
    }

    // Store new content (if not exists)
    public function store(Request $request)
    {
        $request->validate([
            'apply' => 'required|string',
            'benefits' => 'required|string',
            'fee_structure' => 'required|string',
            'terms' => 'required|string',
        ]);

        MembershipPage::create([
            'apply' => $request->apply,
            'benefits' => $request->benefits,
            'fee_structure' => $request->fee_structure,
            'terms' => $request->terms,
        ]);

        return redirect()->back()->with('success', 'Content added successfully.');
    }

    // Update content (for a specific id, mostly 1 row hi hoga)
    public function update(Request $request, $id)
    {
        $request->validate([
            'apply' => 'required|string',
            'benefits' => 'required|string',
            'fee_structure' => 'required|string',
            'terms' => 'required|string',
        ]);

        $member = MembershipPage::findOrFail($id);
        $member->update([
            'apply' => $request->apply,
            'benefits' => $request->benefits,
            'fee_structure' => $request->fee_structure,
            'terms' => $request->terms,
        ]);

        return redirect()->back()->with('success', 'Content updated successfully.');
    }

    // Delete content (optional — usually not needed for static content)
    public function destroy($id)
    {
        $member = MembershipPage::findOrFail($id);
        $member->delete();

        return redirect()->back()->with('success', 'Content deleted successfully.');
    }
}
