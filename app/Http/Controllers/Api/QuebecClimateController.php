<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{QuebecClimateResource, QuebecClimateSeasonalResource, QuebecClimatePackingListResource};
use App\Models\{QuebecClimate, QuebecClimatePackingList, QuebecClimateSeasonal};

class QuebecClimateController extends Controller
{

    public function index()
    {

        $quebecClimate = QuebecClimate::all();

        return QuebecClimateResource::collection($quebecClimate);

    }

    public function seasonal($quebecClimateId)
    {

        $quebecClimateSeasonal = QuebecClimateSeasonal::where('quebec_climate_id', $quebecClimateId)->first();

       // Return the single resource
        return new QuebecClimateSeasonalResource($quebecClimateSeasonal);

    }

    public function packingList($quebecClimateId)
    {

        $quebecClimatePackingList = QuebecClimatePackingList::with('quebecClimate')->where('quebec_climate_id', $quebecClimateId)->get();

        return QuebecClimatePackingListResource::collection($quebecClimatePackingList);

    }

}
