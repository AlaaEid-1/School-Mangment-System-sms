<?php
namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date', 
        ]);
    
        // Create a new event instance and fill it with the form data
        $event = new Event();
        $event->title = $validatedData['title'];
        $event->start_date = $validatedData['start_date'];
        $event->end_date = $validatedData['end_date'];
    
        // Save the event to the database
        $event->save();
    
        // Optionally, you can also add the event to the calendar here
    
        // Redirect back or return a response
        return redirect()->back()->with('success', 'Event saved successfully.');
    }
    public function index()
    {
        $events = Event::all(); // Retrieve events from the database
        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => $event->title,
                'start' => $event->start_date,
                'end' => $event->end_date,
                // Additional event properties if needed
            ];
        }

        return response()->json($formattedEvents);
    }
}