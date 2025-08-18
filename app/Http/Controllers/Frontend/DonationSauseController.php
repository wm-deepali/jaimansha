<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\admin\donations\DonationSause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class DonationSauseController extends Controller
{

    public function index()
{
    $categories = \App\Models\admin\donations\DonationCategory::where('status', 1)->get();
    return view('frontend.home.sections.introduction', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        // your validation rules
    ]);

    // Google reCAPTCHA verification
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => env('RECAPTCHA_SECRET_KEY'),
        'response' => $request->input('g-recaptcha-response'),
    ]);

    $result = $response->json();

    if (!($result['success'] ?? false)) {
        return back()->withErrors(['captcha' => 'Captcha verification failed'])->withInput();
    }

    // Ensure amount or custom_amount is present
    if (empty($request->amount) && empty($request->custom_amount)) {
        return back()->withErrors(['amount' => 'Please select or enter an amount'])->withInput();
    }

    // Handle profile picture upload - Save in public/uploads
    $profilePicturePath = null;
    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $profilePicturePath = 'uploads/' . $filename;
    }

    // Handle same_as_mobile
    $whatsappNumber = $request->whatsapp_number;
    if ($request->boolean('same_as_mobile') && $request->mobile_number) {
        $whatsappNumber = $request->mobile_number;
    }

    // Prepare data for DB insertion
    $data = $request->only([
        'name',
        'email',
        'mobile_number',
        'full_address',
        'country',
        'state',
        'city',
        'pin_code',
        'donation_category_id',
        'payment_method',
    ]);

    $data['whatsapp_number'] = $whatsappNumber;
    $data['same_as_mobile'] = $request->boolean('same_as_mobile');
    $data['profile_picture'] = $profilePicturePath;
    $data['amount'] = $request->amount;
    $data['custom_amount'] = $request->custom_amount ?: null;

    DonationSause::create($data);

    return redirect()->back()
        ->with('success', 'Donation successfully added.');
}


}
