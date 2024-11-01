<?php

namespace App\Http\Controllers;

use App\DataTables\CurrentTrendDataTable;
use App\Http\Resources\CurrentTrendResource;
use App\Models\CurrentTrend;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class QuebecCurrentTrendController extends Controller
{
    use ApiResponseTrait;
    public function getCurrentTrends()
    {
        try{
            $trends = CurrentTrend::get();
            $data =  CurrentTrendResource::collection($trends);
            return $this->apiResponse($data, 'Current Trends Fetched Successfully');
        }catch(\Exception $e)
        {
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);

        }
      
    }

    ////////////////ADMIN PANEL///////////////////////
    public function index(CurrentTrendDataTable $dataTable)
    {
        // $trends = CurrentTrend::get();
        return $dataTable->render('currenttrend.index');
        
    }

    public function create()
    {
        return view('currenttrend.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'media_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/currentTrend_logos');
            $image->move($imagePath, $imageName);
            
            // Create the image URL
            $imageUrl = 'assets/currentTrend_logos/' . $imageName;

            // $imageUrl = asset('assets/service_images/' . $imageName);
        }

        // Create a new service
        $service = new CurrentTrend();
        $service->title = $request->title;
        $service->category = $request->category;
        $service->media_url = $imageUrl ?? null; 
        $service->save();
        
        return redirect()->route('quebec.current.trend.index')->with('success', 'Current Trend created successfully.');
    }

    public function edit($id)
    {
        $trend =  CurrentTrend::find($id);
        return view('currenttrend.edit',compact('trend'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'media_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $trend = CurrentTrend::findOrFail($id);
        $trend->title = $request->title;
        $trend->category = $request->category;


        // Handle image upload if a new image is provided
        if ($request->hasFile('media_url')) {
            // Delete the old image if necessary
            // Storage::delete(public_path('assets/services/' . basename($service->image_url))); // Optional cleanup

            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/currentTrend_logos');
            $image->move($imagePath, $imageName);

            $trend->image_url = 'assets/currentTrend_logos/' . $imageName;

        }

        $trend->save();

        return redirect()->route('quebec.current.trend.index')->with('success', 'Service updated successfully.');
    }

    public function delete($id)
    {
        $trend = CurrentTrend::find($id);
    
        if ($trend) {
            if ($trend->media_url) {
                $imagePath = public_path($trend->media_url); 
    
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }
            }
              $trend->delete();
    
            return redirect()->route('quebec.current.trend.index')->with('success', 'trend deleted successfully.');
        }
    
        return redirect()->route('quebec.current.trend.index')->with('error', 'trend not found.');
    }
}
