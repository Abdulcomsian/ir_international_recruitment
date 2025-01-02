<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoricalEvents;
use Illuminate\Support\Facades\DB;
use App\Models\HistoricalEventsMedia;
use App\DataTables\HistoricalEventsDataTable;

class HistoricalEventsController extends Controller
{
    public function index(HistoricalEventsDataTable $datatable)
    {
        return $datatable->render('historicalevents.index');
    }
    // public function datatables(HistoricalEventsDataTable $datatable)
    // {
    //     return $datatable->ajax();
    // }

    public function create()
    {
        return view('historicalevents.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules=[
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|mimes:jpeg,jpg,png,svg',
            'details' => 'nullable|string',
            'extra_images.*' => 'nullable|mimes:jpeg,jpg,png,svg',
        ];

        $validate= $request->validate($rules,[]);

        DB::beginTransaction();
        try{

            $Historical_events = new HistoricalEvents();
            $Historical_events->title = $request->title;
            $Historical_events->description = $request->description;
            $Historical_events->details = $request->details;
            $Historical_events->save();

            // $Historical_events = HistoricalEvents::create([
            //     'title' => $request->title,
            //     'description' => $request->description,
            //     'details' => $request->details,
            // ]);

            //add the featured image
            if($request->hasFile('featured_image')){
                $image = $request->file('featured_image');
                $imageName = time() . '.'. $image->getClientOriginalExtension();
                $imagePath = public_path('assets\HistoricalEvents_image');
                $image->move($imagePath,$imageName);

                //store in db
                $media = new HistoricalEventsMedia();
                $media->historical_events_id = $Historical_events->id;
                $media->is_featured = true;
                $media->media_url = $imageName;
                $media->save();

            }

            //add the extra images
            if(isset($request->extra_images)){
                $images = is_array($request->extra_images) ? $request->extra_images : [$request->extra_images];
                foreach($images as $image){
                    $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                    $imagePath = public_path('assets/HistoricalEvents_image');
                    $image->move($imagePath,$imageName);

                    //store image
                    $media = new HistoricalEventsMedia();
                    $media->historical_events_id = $Historical_events->id;
                    $media->is_featured = false;
                    $media->media_url = $imageName;
                    $media->save();

                }
            }
            DB::commit();
            return redirect()->route('quebec.historical.event.index')->with('success','Major Historical Events Added Successfully');
        }catch(\Exception $e)
        {
          DB::rollback();
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);
        }
    }

    public function edit($id)
    {
        $historical_event = HistoricalEvents::with('media')->find($id);
        $featured_image = $historical_event->media->where('is_featured',true)->first();
        $extra_images  = $historical_event->media->where('is_featured',false);


        // dd()
        return view('historicalevents.edit',compact('historical_event', 'featured_image', 'extra_images'));
    }

    public function delete($id)
    {
        $Historical_events = HistoricalEvents::with('media')->find($id);
        if($Historical_events)
        {
            foreach ($Historical_events->media as $media) {
                $mediaPath = public_path('assets/HistoricalEvents_image/' . $media->media_url);
                if (file_exists($mediaPath)) {
                    unlink($mediaPath); // Deletes the file from storage
                }

                // Optionally delete the media record from the database
                $media->delete();
            }

        }
        // return response($Historical_events->toArray());
        $Historical_events->delete();

        return redirect()->route('quebec.historical.event.index')->with('success','Major Historical Events Added Successfully');

    }
}
