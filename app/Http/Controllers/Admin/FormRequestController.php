<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FormRequest;

class FormRequestController extends Controller
{
    // Show all records
    public function index()
    {
        $formRequests = FormRequest::all();
        return view('admin.form_requests.index', compact('formRequests'));
    }

    // Show form to create new record
    public function create()
    {
        return view('admin.form_requests.create');
    }

    // Store new record
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'text'  => 'required|string',
        ]);

        FormRequest::create($request->only('name', 'email', 'text'));

        return redirect()->route('admin.form_requests.index')->with('success', 'Form request created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $formRequest = FormRequest::findOrFail($id);
        return view('admin.form_requests.edit', compact('formRequest'));
    }

    // Update record
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'text'  => 'required|string',
        ]);

        $formRequest = FormRequest::findOrFail($id);
        $formRequest->update($request->only('name', 'email', 'text'));

        return redirect()->route('admin.form_requests.index')->with('success', 'Form request updated successfully.');
    }

    // Delete record
    public function destroy($id)
    {
        FormRequest::findOrFail($id)->delete();
        return redirect()->route('admin.form_requests.index')->with('success', 'Form request deleted successfully.');
    }
}
