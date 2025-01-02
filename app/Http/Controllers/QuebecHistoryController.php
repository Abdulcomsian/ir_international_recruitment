<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\QuebecHistory;
use App\Models\QueueHistoryMedia;
use Illuminate\Support\Facades\DB;
use App\DataTables\QuebecHistoryDataTable;
use App\Http\Resources\HistoryResource;

class QuebecHistoryController extends Controller
{
    //////////API//////////////////////////
    public function quebecHistory()
    {
        $culture = QuebecHistory::with('media')->get();
        return  HistoryResource::collection($culture);
    }

    ///////ADMIN PANEL//////////////////////
    public function index(QuebecHistoryDataTable $dataTable)
    {
        return $dataTable->render('history.index');
    }

    public function create()
    {
        return view('history.create');
    }

    public function store(Request $request)
    {
        //Validate Rules
        $rules = [
            'title' => 'nullable|string',
            'description' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'featured_image' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
            'extra_images.*' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
        ];

        $validate = $request->validate($rules,[]);
        try{

            $history = QuebecHistory::create([
                'title'=> $request->title,
                'description' => $request->description,
                'details' => $request->details,
            ]);

            //handle the featured Images
            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecHistory_images');
                $image->move($imagePath, $imageName);

                 //store Path
                 $media = new QueueHistoryMedia;
                 $media->quebec_history_id = $history->id;
                 $media->is_featured = true;
                 $media->media_url =  $imageName;
                 $media->save();
            }

            //here Handel the extra images

            if(isset($request->extra_images)) {
                $images = is_array($request->extra_images) ? $request->extra_images : [$request->extra_images];

                foreach($images as $image)
                {
                    $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                    $imagePath = public_path('assets/QuebecHistory_images');
                    $image->move($imagePath, $imageName);

                    //store Path
                    $media = new QueueHistoryMedia;
                    $media->quebec_history_id = $history->id;
                    $media->is_featured = false;
                    $media->media_url =  $imageName;
                    $media->save();
                }
            }
            return redirect()->route('quebec.history.index')->with('success', 'Service created successfully.');
        }catch(Exception $e){
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);

        }
    }

    public function edit($id)
    {
        $history = QuebecHistory::with('media')->find($id);
        $featuredImage = $history->media->where('is_featured', true)->first();
        $extraImages = $history->media->where('is_featured', false);

        return view('history.edit', compact('history','featuredImage','extraImages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'details' => 'nullable|string',
            'featured_image' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
            'extra_images.*' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
        ]);

        DB::beginTransaction();

        try {
            $history = QuebecHistory::findOrFail($id);
            $history->title = $request->title ?? $history->title;
            $history->description = $request->description ?? $history->description;
            $history->details = $request->details ?? $history->details;

            // Handle featured image upload if a new image is provided
            if ($request->hasFile('featured_image')) {
                // Get the existing featured image
                $existingFeaturedImage = $history->media()->where('is_featured', true)->first();

                // If an existing featured image exists, delete it
                if ($existingFeaturedImage) {
                    $oldImagePath = public_path("assets/QuebecHistory_images/$existingFeaturedImage->media_url");
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Remove old image
                    }
                    // Update the existing featured image record
                    // $existingFeaturedImage->media_url = time() . '_' . $request->file('featured_image')->getClientOriginalExtension();
                    // $existingFeaturedImage->save();
                } else {
                    // Create a new entry if none exists
                    $existingFeaturedImage = new QueueHistoryMedia();
                }

                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecHistory_images');
                $image->move($imagePath, $imageName);

                // Save or update the featured image entry
                $existingFeaturedImage->media_url = $imageName;
                $existingFeaturedImage->is_featured = true;
                $existingFeaturedImage->quebec_history_id = $history->id; // Assuming you have this relationship
                $existingFeaturedImage->save();
            }

            // Handle extra images upload if provided
            if ($request->hasFile('extra_images')) {
                foreach ($request->file('extra_images') as $extraImage) {
                    $extraImageName = time() . '_' . uniqid() . '_' . $extraImage->getClientOriginalExtension();
                    $extraImagePath = public_path('assets/QuebecHistory_images');
                    $extraImage->move($extraImagePath, $extraImageName);

                    // Store the new image in the media table
                    $history->media()->create([
                        'media_url' => $extraImageName,
                        'is_featured' => false, // Mark as not featured
                    ]);
                }
            }

            $history->save();
            DB::commit();

            return redirect()->route('quebec.history.index')->with('success', 'History updated successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage().' on line '.$e->getLine().' in file '.$e->getFile()], 500);
        }
    }

    public function update1(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'details' => 'nullable|string',
            'featured_image' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
            'extra_images.*' => 'nullable|image|max:10240|mimes:png,jpg,jpeg,gif',
        ]);

        DB::beginTransaction();

        try {
            $history = QuebecHistory::findOrFail($id);
            $history->title = $request->title ?? $history->title;
            $history->description = $request->description ?? $history->description;
            $history->details = $request->details ?? $history->details;

            // Handle featured image upload if a new image is provided
            if ($request->hasFile('featured_image')) {
                // Delete old featured image if necessary (optional)
                if ($history->media_url) {
                    $oldImagePath = public_path($history->media_url);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Remove old image
                    }
                }

                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/history_images');
                $image->move($imagePath, $imageName);

                $history->media()->create([
                        'media_url' => 'assets/history_images/' . $imageName,
                        'is_featured' => 'true',
                    ]);
            }

            // Handle extra images upload if provided
            if ($request->hasFile('extra_images')) {
                foreach ($request->file('extra_images') as $extraImage) {
                    $extraImageName = time() . '_' . uniqid() . '.' . $extraImage->getClientOriginalExtension();
                    $extraImagePath = public_path('assets/history_images');
                    $extraImage->move($extraImagePath, $extraImageName);

                    // Store the new image in the media table (assuming you have a relationship set up)
                    $history->media()->create([
                        'media_url' => 'assets/history_images/' . $extraImageName,
                        'is_featured' => 'false', // Mark as not featured
                    ]);
                }
            }

            $history->save();
            DB::commit();

            return redirect()->route('quebec.history.index')->with('success', 'History updated successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage().' on line '.$e->getLine().' in file '.$e->getFile()], 500);
        }
    }

    public function delete($id)
    {
        $history = QuebecHistory::find($id);
        $history->delete();
        return redirect()->route('quebec.history.index')->with('success', 'Service deleted successfully.');
    }
}
