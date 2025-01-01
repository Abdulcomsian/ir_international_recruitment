<?php

namespace App\Http\Controllers;

use App\Models\{AgoraEvent};
use App\DataTables\AgoraEventDataTable;
use App\Http\Requests\AgoraEvent\{StoreRequest, UpdateRequest};
use App\Traits\RemoveFileTrait;

class AgoraEventController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(AgoraEventDataTable $dataTable)
    {
        return $dataTable->render('activities.agora-events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.agora-events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            //handle img
            if ($request->hasFile('img')) {

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/AgoraEvent');
                $image->move($imagePath, $imageName);
            }

            AgoraEvent::create([
                'img' => $imageName,
                'title' => $request->title,
                'price' => $request->price,
                'event_datetime' => $request->event_datetime,
                'hosted_by' => $request->hosted_by,
                'members' => $request->members,
                'location' => $request->location,
                'description' => $request->description
            ]);

            return redirect()->route('activities.agora-events.index')->with('success', 'Agora Event created successfully');
        } catch (\Exception $e) {
            return redirect()->route('activities.agora-events.index')->with('error', 'An error occured while creating Agora Event');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($agoraEventId)
    {
        try {

            $agoraEvent = AgoraEvent::findOrFail($agoraEventId);

            return view('activities.agora-events.show', compact('agoraEvent'));

        } catch (\Exception $e) {
            return redirect()->route('activities.agora-events.index')->with('error', 'Agora Event not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($agoraEventId)
    {

        try {

            $agoraEvent = AgoraEvent::findOrFail($agoraEventId);

            return view('activities.agora-events.edit', compact('agoraEvent'));

        } catch (\Exception $e) {
            return redirect()->route('activities.agora-events.index')->with('error', 'Agora Event not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $agoraEventId)
    {

        try {

            $agoraEvent = AgoraEvent::findOrFail($agoraEventId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/AgoraEvent/$agoraEvent->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/AgoraEvent');
                $image->move($imagePath, $imageName);

                $agoraEvent->img = $imageName;
            }

            $agoraEvent->title = $request->title;
            $agoraEvent->price = $request->price;
            $agoraEvent->event_datetime = $request->event_datetime;
            $agoraEvent->hosted_by = $request->hosted_by;
            $agoraEvent->members = $request->members;
            $agoraEvent->location = $request->location;
            $agoraEvent->description = $request->description;

            $agoraEvent->save();

            return redirect()->route('activities.agora-events.index')->with('success', 'Agora Event updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('activities.agora-events.index')->with('error', 'An error occured while updating Agora Event');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($agoraEventId)
    {

        try {

            $agoraEvent = AgoraEvent::findOrFail($agoraEventId);
            $this->unlinkFile("assets/AgoraEvent/$agoraEvent->img");
            $agoraEvent->delete();
            return redirect()->route('activities.agora-events.index')->with('success', 'Agora Event deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('activities.agora-events.index')->with('error', 'An error occurred while deleting Agora Event');
        }

    }


}
