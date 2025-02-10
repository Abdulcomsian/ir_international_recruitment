<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\UploadCityVideo;
use App\DataTables\UploadCityVideoDataTable;
use App\Traits\RemoveFileTrait;

class UploadCityVideoController extends Controller
{
    use RemoveFileTrait;
    public function index(UploadCityVideoDataTable $dataTable, City $city)
    {
        // dd($city);
        $id = $city->id;
        $dataTable->Id = $id; 
        // dd($id);
        // $city = City::find($id);
        return $dataTable->render('cities.videos.index',compact('id'));
    }

    public function create($id)
    {
        // dd($id);
        // dd("do you want to create a video");
        return view('cities.videos.create',compact('id'));
    }

    public function store(Request $request,$id)
    {
        // dd($id);
        $request->validate([
            'video_url'=> 'string',
            'is_Active' => 'string|in:yes,no',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the max size as needed
        ]);
        // Handle the image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/cityVideo_images');
            $image->move($imagePath, $imageName);

            // Create the image URL
            $imageUrl = 'assets/cityVideo_images/' . $imageName;

            // $imageUrl = asset('assets/service_images/' . $imageName);
        }
        // dd($request->all());
        $cityVideo = UploadCityVideo::create([
            'city_id' => $id,
            'video_url' => $request->video_url,
            'is_Active' => $request->is_Active,
            'featured_image' => $imageUrl,
        ]);

        return redirect()->route('cities.upload-cityVideo.index',$id);
    }

    public function edit(City $city, UploadCityVideo $uploadCityVideo)
    {
        $cityId = $city->id;
        $uploadVideoId = $uploadCityVideo->id;

        return view('cities.videos.edit', compact('city', 'uploadCityVideo'));
    }

    public function update(Request $request, City $city, UploadCityVideo $uploadCityVideo)
    {
        if ($uploadCityVideo->city_id !== $city->id) {
            abort(404, 'This video does not belong to the specified city.');
        }

        // Validate the request data.
        $validated = $request->validate([
            'video_url'      => 'required|string',
            'is_Active'      => 'required|string|in:yes,no',
            'featured_image' => 'sometimes|image|max:2048',
        ]);

        // Update the video record.
        $uploadCityVideo->video_url = $validated['video_url'];
        $uploadCityVideo->is_Active = $validated['is_Active'];

         // Handle image upload if a new image is provided
         if ($request->hasFile('featured_image')) {
            // remove Old img 
            $this->unlinkFile($uploadCityVideo->featured_image);
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/cityVideo_images');
            $image->move($imagePath, $imageName);

            $media_url = 'assets/cityVideo_images/' . $imageName;

        }
        $uploadCityVideo->featured_image = $media_url ?? $uploadCityVideo->featured_image;

        $uploadCityVideo->save();

        // Redirect back to the index (or any desired route) with a success message.
        return redirect()->route('cities.upload-cityVideo.index', $city->id)
            ->with('success', 'City video updated successfully.');
    }

    public function destroy(City $city, UploadCityVideo $uploadCityVideo)
    {
        try{
            $video = $uploadCityVideo->delete();
            return redirect()->route('cities.upload-cityVideo.index', $city->id)
            ->with('success', 'City video deleted successfully.');
        }catch(\Exception $e){
            return response()->json([
                'msg'=> $e->getMessage()
            ]);

        }
        
    }


}
