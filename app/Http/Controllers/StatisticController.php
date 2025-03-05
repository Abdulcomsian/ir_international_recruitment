<?php

namespace App\Http\Controllers;

use App\DataTables\StatisticsDataTable;
use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Traits\RemoveFileTrait;

class StatisticController extends Controller
{
    use  RemoveFileTrait;

    public function getStatisticsBeautyCards()
    {
        $staticCards = Statistic::get();
        return response()->json([
            'status'=> true,
            'msg' => 'Data Fetched Successfully',
            'data' => $staticCards
        ]);
    }

    public function index(StatisticsDataTable $dataTable)
    {
        return $dataTable->render('statisticsCards.index');
    }

    public function create()
    {
        return view('statisticsCards.create'); // Create a view file named create.blade.php
    }

    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            
            'media_url' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Adjust the max size as needed
            'video_url' => 'nullable|string',
        ]);

        // Handle the image upload
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/employee_statistics');
            $image->move($imagePath, $imageName);

            // Create the image URL
            $imageUrl = 'assets/employee_statistics/' . $imageName;

        }

        $state = new Statistic();
     
        $state->image = $imageUrl ?? null;
        $state->video_url = $request->video_url;

        $state->save();

        // Optionally redirect if not using JSON response
        return redirect()->route('quebec.statistics.cards.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $state = Statistic::find($id);
        return view('statisticsCards.edit',compact('state'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           
            'media_url' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Adjust the max size as needed
            'video_url' => 'nullable|string|max:255',

        ]);

        $state = Statistic::findOrFail($id);
    
        $state->video_url = $request->video_url;

        // Handle image upload if a new image is provided
        if ($request->hasFile('media_url')) {
            // remove Old img
            $this->unlinkFile($state->media_url);
            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/employee_statistics');

            $image->move($imagePath, $imageName);

            $media_url = 'assets/employee_statistics/' . $imageName;
            $state->image = $media_url ?? null;



        }

        $state->save();

        return redirect()->route('quebec.statistics.cards.index')->with('success', 'Employee Statistics updated successfully.');
    }

    public function delete($id)
    {
        $state= Statistic::find($id);
        if($state)
        {
            if($state->media_url){
                $image= public_path($state->media_url);
                if(file_exists($image))
                {
                    unlink($image);
                }
            }
        }
        $state->delete();
        return redirect()->route('quebec.statistics.cards.index')->with('success', 'Service deleted successfully.');

    }
}
