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
    // Recent or other events (excluding current)
    $recentEvents = Event::where('slug', '!=', $slug)
      ->latest()        // Sort by newest
      ->take(5)         // Show top 5 (adjust as needed)
      ->get();
    return view('frontend.events_details.index',  compact('event', 'recentEvents'));
  }

}
