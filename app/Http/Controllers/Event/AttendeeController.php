<?php

namespace App\Http\Controllers\Event;

use App\Events\UserRepliedEvent;
use App\Exports\AttendeeExport;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\CreateAttendeeRequest;
use App\Http\Requests\InvitationStoreRequest;
use App\Http\Requests\UploadAtteneeRequest;
use App\Imports\ImportAttendee;
use App\Models\Attendee;
use App\Models\AttendeeToken;
use App\Models\Event;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttendeeController extends Controller
{

    /**
     * Display list of all attendees from all events
     */
    public function all(){
        $attendees = Attendee::select(['id', 'name', 'email', 'phone', 'entity'])->distinct()->get();
        return view('dashboard.pages.attendees.all', compact('attendees'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $attendees = Attendee::where('event_id', $event->id)->get();
        return view("dashboard.pages.attendees.index", ['attendees' => $attendees, 'event' => $event]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        return view('dashboard.pages.attendees.create', ['event_id' => $event->id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAttendeeRequest $request)
    {
        $request->validated();
        $event = Event::find($request->event_id);
        $attendee = Attendee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'entity' => $request->entity,
            'event_id' => $request->event_id,
        ]);

        Helper::invite($attendee, $event);
        return to_route('attendee.create', $request->event_id)->with('addedSuccessfully', "The attendee added successfully.");
    }


    public function invitation_store(InvitationStoreRequest $request)
    {
        $attendee = $request->validated();

        $token = AttendeeToken::firstWhere('token', $attendee['token']);
        $token->attendee->update($attendee);




        $token->attendee->events()->attach($token->event_id,
        [
            'attendee_id'=> $token->attendee_id,
            'confirmation'=> $attendee['confirmation'],
            'reason'=> $attendee['reason'] ?? null,
            // 'created_at'=> now(),
            // 'updated_at'=> now(),
        ]);

        UserRepliedEvent::dispatch($attendee);
        return view('dashboard.pages.events.preview.thanks', ['token'=>$token->token]);
    }



    /**
     * Upload attendees list form.
     */
    public function upload(UploadAtteneeRequest $request){
        $file = $request->validated();

        if($request->hasFile('attendee')){
            $attendees = Excel::toArray(new ImportAttendee, $request->file('attendee'));
            return redirect()->route('attendee.show_list', ['attendees' => $attendees, 'event_id'=>$request->event_id]);
        }

        return to_route('attendee.index');
    }


    /**
     * Display list of attendee's before storing it.
     */
    public function show_list(Request $request){
        return view('dashboard.pages.attendees.show_list', ['attendees'=> $request->query('attendees'), 'event_id'=>$request->event_id]);
    }


    /**
     * Store attendee's list
     */
    public function upload_list(Request $request){
        $event = Event::find($request->event_id);
        for ($i=1; $i <= (count($request->all()) -1) / 4; $i++) { 
            $attendee = Attendee::create([
                "name" => $request->input("name$i"),
                "email" => $request->input("email$i"),
                "phone" => $request->input("phone$i"),
                "entity" => $request->input("entity$i"),
                "event_id" => $event->id,
                "confirmation" => 'pending',
                "status" => 0
            ]);

            Helper::invite($attendee, $event);
        }

        return to_route('attendee.index', $request->event_id)->with("addedSuccessfully", "All attendees added successfully.");
    }


    /**
     * Export Attendees list into excel sheet.
     */
    public function export($id = 0)
    {
        return Excel::download(new AttendeeExport($id), 'attendees.xlsx');
    }


    /**
     * Display the specified resource.
     */
    public function show(Attendee $attendee)
    {
        $events = Attendee::where('email', $attendee->email)->get('event_id');
        return view('dashboard.pages.attendees.show', ['attendee'=>$attendee, 'events' => $events]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendee $attendee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendee $attendee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendee $attendee)
    {
        //
    }
}
