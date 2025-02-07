<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\UploadCityVideo;
use App\DataTables\UploadCityVideoDataTable;

class UploadCityVideoController extends Controller
{
    public function index(UploadCityVideoDataTable $dataTable, City $city)
    {
        // dd($city);
        $id = $city->id;
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
            'is_Active' => 'string|in:yes,no'
        ]);
        // dd($request->all());
        $cityVideo = UploadCityVideo::create([
            'city_id' => $id,
            'video_url' => $request->video_url,
            'is_Active' => $request->is_Active
        ]);

        return redirect()->route('cities.upload-cityVideo.index',$id);
    }
}
