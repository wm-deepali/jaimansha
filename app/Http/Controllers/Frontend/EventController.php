<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Event;

class EventController extends Controller
{
  public function index()
{
    // $events = Event::all();
    $events = Event::all();
    return view('frontend.events.index', compact('events'));
}

public function show($slug)
{
    $event = Event::where('slug', $slug)->firstOrFail();
    return view('frontend.events_details.index', compact('event'));
}


}
