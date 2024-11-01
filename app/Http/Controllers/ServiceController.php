<?php

namespace App\Http\Controllers;

use App\DataTables\ServicesDataTable;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;
use App\Models\Service;
class ServiceController extends Controller
{
    // ///////////APIS////////////////////////////////////
    public function getService()
    {
        try{
            $service =  Service::get();
            return  ServiceResource::collection($service);

        }catch(\Exception $e){
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);
        }
       
    }

    ///////////API end HERE/////////////////////////

    /////////////ADMIN PANEL FUNCTIONS///////////////
    public function fetchService(ServicesDataTable $dataTable)
    {

        return $dataTable->render('services.index');

    }

    public function create()
    {
        return view('services.create'); // Create a view file named create.blade.php
    }


    public function addService(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the max size as needed
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/service_images');
            $image->move($imagePath, $imageName);
            
            // Create the image URL
            $imageUrl = 'assets/service_images/' . $imageName;

            // $imageUrl = asset('assets/service_images/' . $imageName);
        }

        // Create a new service
        $service = new Service();
        $service->title = $request->title;
        $service->image_url = $imageUrl ?? null; 
        $service->save();
        
        // Optionally redirect if not using JSON response
        return redirect()->route('fetch-services')->with('success', 'Service created successfully.');
    }


    public function editService($id)
    {
        $service =  Service::find($id);
        return view('services.edit',compact('service'));
    }

    public function updateService (Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $service->title = $request->title;

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if necessary
            // Storage::delete(public_path('assets/services/' . basename($service->image_url))); // Optional cleanup

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/service_images');
            $image->move($imagePath, $imageName);

            $service->image_url = 'assets/service_images/' . $imageName;

        }

        $service->save();

        return redirect()->route('fetch-services')->with('success', 'Service updated successfully.');
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
    
        // Check if the service exists
        if ($service) {
            // Delete the associated image if it exists
            if ($service->image_url) {
                // Construct the correct path to the image
                $imagePath = public_path($service->image_url); // Use public_path to get the full path
    
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }
            }
    
            // Delete the service record
            $service->delete();
    
            return redirect()->route('fetch-services')->with('success', 'Service deleted successfully.');
        }
    
        return redirect()->route('fetch-services')->with('error', 'Service not found.');
    }
    
    
    ////////////ADMIN PANEL FUNCTIONS END HERE///////
}
