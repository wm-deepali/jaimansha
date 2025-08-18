<?php

namespace App\Http\Controllers\Admin\DonationSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\donationsetting\Donation;

class DonationController extends Controller
{
    // ✅ Show all donation settings
    public function index()
    {
        $donations = Donation::all();
        return view('admin.donation.index', compact('donations'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('admin.donation.create');
    }

    // ✅ Store new donation setting
    public function store(Request $request)
    {
        $request->validate([
           'qr_code_url' => 'nullable|mimes:png,jpg,jpeg,svg|max:20480',
            'upi_id' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $data = $request->all();

        // ✅ Handle QR code upload
        if ($request->hasFile('qr_code_url')) {
            $file = $request->file('qr_code_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/qr_codes'), $filename);
            $data['qr_code_url'] = 'uploads/qr_codes/' . $filename;
        }

        Donation::create($data);

        return redirect()->route('admin.donation.index')->with('success', 'Donation setting added successfully.');
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donation.edit', compact('donation'));
    }

    // ✅ Update donation setting
    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $request->validate([
            'qr_code_url' => 'nullable|mimes:png,jpg,jpeg,svg|max:20480',
            'upi_id' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $data = $request->all();

        // ✅ Handle QR code upload
        if ($request->hasFile('qr_code_url')) {
            // delete old file if exists
            if ($donation->qr_code_url && file_exists(public_path($donation->qr_code_url))) {
                unlink(public_path($donation->qr_code_url));
            }

            $file = $request->file('qr_code_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/qr_codes'), $filename);
            $data['qr_code_url'] = 'uploads/qr_codes/' . $filename;
        }

        $donation->update($data);

        return redirect()->route('admin.donation.index')->with('success', 'Donation setting updated successfully.');
    }

    // ✅ Delete donation setting
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);

        // delete qr code file if exists
        if ($donation->qr_code_url && file_exists(public_path($donation->qr_code_url))) {
            unlink(public_path($donation->qr_code_url));
        }

        $donation->delete();

        return redirect()->route('admin.donation.index')->with('success', 'Donation setting deleted successfully.');
    }
}
