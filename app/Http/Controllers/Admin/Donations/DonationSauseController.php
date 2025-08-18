<?php

namespace App\Http\Controllers\Admin\Donations;

use App\Http\Controllers\Controller;
use App\Models\admin\donations\DonationSause;
use App\Models\admin\donations\DonationCategory;
use Illuminate\Http\Request;

class DonationSauseController extends Controller
{
    public function index()
    {
        $donations = DonationSause::with('category')->paginate(15);
        return view('admin.donations.donation_sauses.index', compact('donations'));
    }

    public function create()
    {
        $categories = DonationCategory::where('status', 1)->get();
        return view('admin.donations.donation_sauses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'mobile_number',
            'whatsapp_number',
            'same_as_mobile',
            'full_address',
            'country',
            'state',
            'city',
            'pin_code',
            'donation_category_id',
            'amount',
            'custom_amount',
            // 'payment_method',
        ]);

        // Missing fields ko null set karo
        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                $data[$key] = null;
            }
        }

        // File upload handling
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['profile_picture'] = 'uploads/' . $filename;
        }

        DonationSause::create($data);

        return redirect()->route('admin.donations.sauses.index')
            ->with('success', 'Donation successfully added.');
    }

    public function show($id)
    {
        $donation = DonationSause::with('category')->findOrFail($id);
        return view('admin.donations.donation_sauses.show', compact('donation'));
    }

    public function edit($id)
    {
        $donation = DonationSause::findOrFail($id);
        $categories = DonationCategory::where('status', 1)->get();
        return view('admin.donations.donation_sauses.edit', compact('donation', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $donation = DonationSause::findOrFail($id);

        $data = $request->only([
            'name',
            'email',
            'mobile_number',
            'whatsapp_number',
            'same_as_mobile',
            'full_address',
            'country',
            'state',
            'city',
            'pin_code',
            'donation_category_id',
            'amount',
            'custom_amount',
            // 'payment_method',
        ]);

        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                $data[$key] = null;
            }
        }

        // File upload handling (optional replace)
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['profile_picture'] = 'uploads/' . $filename;
        }

        $donation->update($data);

        return redirect()->route('admin.donations.sauses.index')
            ->with('success', 'Donation successfully updated.');
    }

    public function destroy($id)
    {
        $donation = DonationSause::findOrFail($id);
        $donation->delete();

        return redirect()->route('admin.donations.sauses.index')
            ->with('success', 'Donation successfully deleted.');
    }
}
