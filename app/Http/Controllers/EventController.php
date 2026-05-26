<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:car_show,small_concert,art_gallery,other',
            'description' => 'nullable|string',
            'image' => 'nullable|url|max:2048',
            'event_date' => 'required|date|after_or_equal:today',
        ]);

        $event = Event::create($validated);

        // Generate notifications for all users
        $users = User::all();
        $formattedDate = Carbon::parse($event->event_date)->format('F d, Y');
        
        $typeLabels = [
            'car_show' => 'Car Show 🚗',
            'small_concert' => 'Small Concert 🎸',
            'art_gallery' => 'Art Gallery 🎨',
            'other' => 'Special Event 🎉'
        ];
        $typeLabel = $typeLabels[$event->type] ?? 'Special Event 🎉';

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => "🗓️ {$typeLabel}: {$event->title}",
                'message' => "Mark your calendar! We are hosting a {$typeLabel} on {$formattedDate}. Details: " . ($event->description ?? 'No details provided yet. Don\'t miss out!'),
                'is_read' => false,
            ]);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully and all customers have been notified!');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:car_show,small_concert,art_gallery,other',
            'description' => 'nullable|string',
            'image' => 'nullable|url|max:2048',
            'event_date' => 'required|date',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
