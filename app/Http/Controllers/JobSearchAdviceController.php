<?php

namespace App\Http\Controllers;

use App\DataTables\JobSearchAdviceDataTable;
use App\Models\JobSearchAdvice;
use Illuminate\Http\Request;

class JobSearchAdviceController extends Controller
{
    public function index(JobSearchAdviceDataTable $dataTables)
    {
        return $dataTables->render('jobSearch.index');
    }

    public function create()
    {
        return view('jobSearch.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'media_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/jobSearch_images');
            $image->move($imagePath, $imageName);
            
            // Create the image URL
            $imageUrl = 'assets/jobSearch_images/' . $imageName;

            // $imageUrl = asset('assets/service_images/' . $imageName);
        }

        // Create a new jobserach
        $jobsearch = new JobSearchAdvice();
        $jobsearch->title = $request->title;
        $jobsearch->description = $request->description;
        $jobsearch->media_url = $imageUrl ?? null; 
        $jobsearch->save();
        
        return redirect()->route('job.search.advice.index')->with('success', 'Job Search Advice created successfully.');
    }

    public function edit($id)
    {
        $jobsearch = JobSearchAdvice::find($id);
        return view('jobSearch.edit',compact('jobsearch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'media_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $jobsearch = JobSearchAdvice::findOrFail($id);
        $jobsearch->title = $request->title;
        $jobsearch->description = $request->description;


        // Handle image upload if a new image is provided
        if ($request->hasFile('media_url')) {
            // Delete the old image if necessary
            // Storage::delete(public_path('assets/services/' . basename($service->image_url))); // Optional cleanup

            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/jobSearch_images');
            $image->move($imagePath, $imageName);

            $jobsearch->image_url = 'assets/jobSearch_images/' . $imageName;

        }

        $jobsearch->save();

        return redirect()->route('job.search.advice.index')->with('success', 'jobSearch updated successfully.');
    
    }

    public function delete($id)
    {
        $jobsearch = JobSearchAdvice::find($id);
    
        if ($jobsearch) {
            if ($jobsearch->media_url) {
                $imagePath = public_path($jobsearch->media_url); 
    
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }
            }
              $jobsearch->delete();
    
            return redirect()->route('job.search.advice.index')->with('success', 'jobsearch deleted successfully.');
        }
    
        return redirect()->route('job.search.advice.index')->with('error', 'jobsearch not found.');
    }
}
