<?php

namespace App\Http\Controllers\Event;

use App\Events\EventUpdated;
use App\Http\Controllers\Controller;
use App\Http\Helpers\FileProcessing;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Attendee;
use App\Models\AttendeeToken;
use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all()->sortByDesc('created_at');
        return view("dashboard.pages.events.index", ["events" => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $event = $request->validated();
        $event['admin_id'] = Auth::guard('admin')->user()->id;

        // Extract the 'src' attribute value from the iframe link

        if (!empty($event['location_link'])) {
            $iframe = $event['location_link'];
            $matches = [];
            // Regular expression to capture the src attribute value
            if (preg_match('/src="([^"]+)"/', $iframe, $matches)) {
                $event['location_link'] = $matches[1]; // Get the URL inside the src attribute
            }
        }

        // Save the event
        $event = Event::create($event);

            $path = "events/$event->id";
            $image_name = FileProcessing::file_processing($request->image, $path);
            EventImage::create([
                'image' => $image_name,
                'path' => $path,
                'event_id' => $event->id,
                'location_link' => $event['location_link'],
            ]);

        return to_route('event.create')->with('eventAddedSuccessfully', "The event added Successfully.");
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // $confirmed = Attendee::where('event_id', $event->id)->where('confirmation', 'confirmed')->get()->count();
        $confirmed = DB::table('attendee_event')
        ->where('confirmation', 'confirmed')
        ->where('event_id', $event->id)
        ->count();

        return view("dashboard.pages.events.show", ["event" => $event, 'confirmed' => $confirmed]);
    }


    public function preview(Event $event)
    {
        return view("dashboard.pages.events.preview.preview", ["event" => $event]);
    }


    public function invitation(String $token)
    {
        $token = AttendeeToken::firstWhere('token', $token);
        
        if(! $token)
            abort(404);

        return view("dashboard.pages.events.preview.preview", ["token" => $token]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view("dashboard.pages.events.update", ["event" => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $updated_event = $request->validated();

        // Extract the 'src' attribute value from the iframe link if provided
        if (!empty($updated_event['location_link'])) {
            $iframe = $updated_event['location_link'];
            $matches = [];
            // Regular expression to capture the src attribute value
            if (preg_match('/src="([^"]+)"/', $iframe, $matches)) {
                $updated_event['location_link'] = $matches[1]; // Get the URL inside the src attribute
            }
        }
    
        // Update the event
        $event->update($updated_event);
        EventUpdated::dispatch($event);

        if($request->hasFile('image')){
            $path = "events/$event->id";
            
            $event_image = EventImage::firstWhere('event_id', $event->id);

            Storage::delete("$event_image->path/$event_image->name");
            $event_image->update(['image' => FileProcessing::file_processing($request->image, $path)]);
            $event_image->save();
        }

        return redirect()->route('event.edit', $event)->with('eventUpdatedSuccessfully', "The event updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return to_route('event.index');
    }


}
