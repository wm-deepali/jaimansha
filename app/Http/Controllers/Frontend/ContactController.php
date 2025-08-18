<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contact\Contact;

class ContactController extends Controller
{
    /**
     * Display all contact messages (for admin panel).
     */
    public function index()
    {
        // Latest first
        $contacts = Contact::latest()->get();
        return view('frontend.contact.index', compact('contacts'));
    }

    /**
     * Store new contact form submission.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:20',
            'subject'  => 'required|string|max:255',
            'services' => 'nullable|string|max:255',
            'message'  => 'required|string',
        ]);

        // Save to database
        Contact::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'subject'  => $request->subject,
            'services' => $request->services,
            'message'  => $request->message,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }

    /**
     * Display a specific contact message.
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('frontend.contact.show', compact('contact'));
    }
}
