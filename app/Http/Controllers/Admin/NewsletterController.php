<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Newsletter;

class NewsletterController extends Controller
{
    // Show all records
    public function index()
    {
        $newsletters = Newsletter::all();
        return view('admin.newsletters.index', compact('newsletters'));
    }

    // Show form to create new record
    public function create()
    {
        return view('admin.newsletters.create');
    }

    // Store new record
    public function store(Request $request)
    {
        $request->validate([
            'email'       => 'required|email|max:255|unique:newsletters,email',
            'agree_terms' => 'accepted',
        ]);

        Newsletter::create([
            'email'       => $request->email,
            'agree_terms' => 1,
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter subscriber added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletters.edit', compact('newsletter'));
    }

    // Update record
    public function update(Request $request, $id)
    {
        $request->validate([
            'email'       => 'required|email|max:255|unique:newsletters,email,' . $id,
            'agree_terms' => 'boolean',
        ]);

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->update([
            'email'       => $request->email,
            'agree_terms' => $request->agree_terms ?? 0,
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter subscriber updated successfully.');
    }

    // Delete record
    public function destroy($id)
    {
        Newsletter::findOrFail($id)->delete();
        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter subscriber deleted successfully.');
    }
}
