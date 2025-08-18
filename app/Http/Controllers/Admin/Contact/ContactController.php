<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contact\Contact;

class ContactController extends Controller
{

       public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    // Store contact (agar admin side se manually add karna ho)
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|string|max:20',
            'subject'  => 'required|string|max:255',
            'services' => 'required|string|max:255',
            'message'  => 'required|string'
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Contact added successfully.');
    }

    // Update contact
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|string|max:20',
            'subject'  => 'required|string|max:255',
            'services' => 'required|string|max:255',
            'message'  => 'required|string'
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->back()->with('success', 'Contact updated successfully.');
    }

    // Delete contact
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }
}
