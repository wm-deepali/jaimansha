<?php

namespace App\Http\Controllers\admin\event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\event\EventManagement as Event;

class EventManagmentController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.event.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('thumb_image')) {
            $thumbImage = $request->file('thumb_image');
            $thumbImageName = time().'_thumb.'.$thumbImage->getClientOriginalExtension();
            $thumbImage->move(public_path('uploads/events'), $thumbImageName);
            $data['thumb_image'] = 'uploads/events/' . $thumbImageName;
        }

        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time().'_banner.'.$bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/events'), $bannerImageName);
            $data['banner_image'] = 'uploads/events/' . $bannerImageName;
        }

        Event::create($data);
        return redirect()->route('admin.events.event.index')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $event = Event::findOrFail($id);

        if ($request->hasFile('thumb_image')) {
            $thumbImage = $request->file('thumb_image');
            $thumbImageName = time().'_thumb.'.$thumbImage->getClientOriginalExtension();
            $thumbImage->move(public_path('uploads/events'), $thumbImageName);
            $data['thumb_image'] = 'uploads/events/' . $thumbImageName;
        }

        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time().'_banner.'.$bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/events'), $bannerImageName);
            $data['banner_image'] = 'uploads/events/' . $bannerImageName;
        }

        $event->update($data);
        return redirect()->route('admin.events.event.index')->with('success', 'Event updated.');
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->route('admin.events.event.index')->with('success', 'Deleted successfully.');
    }
}
