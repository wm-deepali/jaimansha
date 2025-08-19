<?php

namespace App\Http\Controllers\Admin\marquee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marquee;
class MarqueeController extends Controller
{

    // List all marquee messages
    public function index()
    {
        $marquees = Marquee::orderBy('created_at', 'desc')->get();
        return view('admin.marquees.index', compact('marquees'));
    }

    // Show form to create a new marquee message
    public function create()
    {
        return view('admin.marquees.create');
    }

    // Store new marquee message
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'link' => 'nullable|url',
        ]);

        Marquee::create($request->only('message', 'link'));

        return redirect()->route('admin.marquees.index')->with('success', 'Marquee message added successfully.');
    }

    // Show form to edit existing marquee message
    public function edit($id)
    {
        $marquee = Marquee::findOrFail($id);
        return view('admin.marquees.edit', compact('marquee'));
    }

    // Update marquee message
    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $marquee = Marquee::findOrFail($id);
        $marquee->update($request->only('message', 'link'));

        return redirect()->route('admin.marquees.index')->with('success', 'Marquee message updated successfully.');
    }

    // Delete marquee message
    public function destroy($id)
    {
        $marquee = Marquee::findOrFail($id);
        $marquee->delete();

        return redirect()->route('admin.marquees.index')->with('success', 'Marquee message deleted successfully.');
    }

}
