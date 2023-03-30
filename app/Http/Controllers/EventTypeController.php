<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventTypeRequest;
use App\Http\Requests\UpdateEventTypeRequest;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventTypes = EventType::all();

        // dd($eventTypes);
        return view('admin.dash.event-type', ["eventTypes" => $eventTypes]);
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
     * @param  \App\Http\Requests\StoreEventTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $eventType = EventType::create([
            'title' => $request->titulo,
            'background_color' => $request->colorFondoNuevo,
            'border_color' => $request->colorBordeNuevo,
            'text_color' => $request->colorTextoNuevo,
        ]);

        return response()->json($eventType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function show(EventType $eventType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function edit(EventType $eventType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventTypeRequest  $request
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $eventType = EventType::find($id);
        if (!$eventType) {
            return response()->json([
                'error' => 'Unable to locale the event'
            ], 404);
        }
        $eventType->update([
            'title' => $request->title,
            'background_color' => $request->backgroundColor,
            'border_color' => $request->borderColor,
            'text_color' => $request->textColor,
        ]);
        return response()->json(
            $eventType
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventType = EventType::find($id);
        if (!$eventType) {
            return response()->json([
                'error' => 'Unable to locate the event type'
            ], 404);
        }
        $eventType->delete();
        return $id;
    }
}
