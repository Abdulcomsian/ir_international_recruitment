<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UploadCityVideo;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityVideoResponse;

class CityVideoController extends Controller
{
    public function getCityVideos($id)
    {
        try{
            $videos = UploadCityVideo::where('city_id',$id)->get();
            return CityVideoResponse::collection($videos);
        }catch(\Exception $e){
            return response()->json([
                'msg' => $e->getMessage()
            ]);
        }
        
    }
}
