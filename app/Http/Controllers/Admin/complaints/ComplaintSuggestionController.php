<?php

namespace App\Http\Controllers\admin\complaints;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\complaints\ComplaintSuggestionModel;

class ComplaintSuggestionController extends Controller
{
    // List all complaints/suggestions
    public function index()
    {
        $complaints = ComplaintSuggestionModel::latest()->paginate(10);
        return view('admin.complaints.index', compact('complaints'));
    }

    // Show form to create new complaint/suggestion
    public function create()
    {
        return view('admin.complaints.create');
    }

    // Store new complaint/suggestion
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:complaint,suggestion',
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mobile_number' => 'required|string|max:15',
            'details' => 'required|string',
        ]);

        ComplaintSuggestionModel::create($validated);

        return redirect()->route('admin.complaints.index')->with('success', 'Entry added successfully.');
    }

    // Show single complaint/suggestion details
    public function show($id)
    {
        $complaint = ComplaintSuggestionModel::findOrFail($id);
        return view('admin.complaints.show', compact('complaint'));
    }

    // Show form to edit complaint/suggestion
    public function edit($id)
    {
        $complaint = ComplaintSuggestionModel::findOrFail($id);
        return view('admin.complaints.edit', compact('complaint'));
    }

    // Update complaint/suggestion
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:complaint,suggestion',
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mobile_number' => 'required|string|max:15',
            'details' => 'required|string',
        ]);

        $complaint = ComplaintSuggestionModel::findOrFail($id);
        $complaint->update($validated);

        return redirect()->route('admin.complaints.index')->with('success', 'Entry updated successfully.');
    }

    // Delete complaint/suggestion
    public function destroy($id)
    {
        $complaint = ComplaintSuggestionModel::findOrFail($id);
        $complaint->delete();

        return redirect()->route('admin.complaints.index')->with('success', 'Entry deleted successfully.');
    }
}
