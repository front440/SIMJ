<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Booking;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(\Auth::user()->id);
        $eventTypes = EventType::all();

        $events = [];
        $bookings = Event::all();

        foreach ($bookings as $event) {
            $events[] = [
                'id'   => $event->id,
                'title' => $event->title,
                'start' => $event->start_date,
                'end' => $event->end_date,
            ];
        }

        return view('admin.dash.index', ["user" => $user, 'events' => $events, 'eventTypes' => $eventTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validación de la respuesta
        $request->validate([
            'title' => 'required|string'
        ]);

        $event = Event::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'id_event_type' => $request->id_event_type,
        ]);

        return response()->json($event);
        return redirect('/admin/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'error' => 'Unable to locale the event'
            ], 404);
        }
        $event->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            // 'id_event_type' => $request->id_event_type,
        ]);
        return response()->json(
            'Event updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $event->delete();
        return $id;
    }
}
