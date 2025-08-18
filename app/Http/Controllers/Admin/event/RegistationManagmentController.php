<?php

namespace App\Http\Controllers\admin\event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\event\RegistationEvent;
use App\Models\admin\event\EventManagement;

class RegistationManagmentController extends Controller
{
    // 🔹 Show all registrations
    public function index()
    {
        $registrations = RegistationEvent::with('event')->latest()->get();
        return view('admin.events.registation.index', compact('registrations'));
    }

    // 🔹 Show create form
    public function create()
    {
        $events = EventManagement::where('status', 1)->get(); // active events
        return view('admin.events.registation.create', compact('events'));
    }

    // 🔹 Store new registration
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email',
            'mobile'    => 'required|string|max:15',
            'event_id'  => 'required|exists:events,id',
            'status'    => 'required|in:0,1',
        ]);

        RegistationEvent::create($request->all());

        return redirect()->route('admin.events.registation.index')->with('success', 'Registration added successfully.');
    }

    // 🔹 Show edit form
    public function edit($id)
    {
        $registration = RegistationEvent::findOrFail($id);
        $events = EventManagement::where('status', 1)->get();
        return view('admin.events.registration.edit', compact('registration', 'events'));
    }

    // 🔹 Update registration
    public function update(Request $request, $id)
    {
        $registration = RegistationEvent::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email',
            'mobile'    => 'required|string|max:15',
            'event_id'  => 'required|exists:events,id',
            'status'    => 'required|in:0,1',
        ]);

        $registration->update($request->all());

        return redirect()->route('admin.events.registation.index')->with('success', 'Registration updated successfully.');
    }

    // 🔹 Delete registration
    public function destroy($id)
    {
        RegistationEvent::findOrFail($id)->delete();

        return redirect()->route('admin.events.registation.index')->with('success', 'Registration deleted successfully.');
    }
}
