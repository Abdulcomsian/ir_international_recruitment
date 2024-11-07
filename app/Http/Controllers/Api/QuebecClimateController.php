<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{QuebecClimateResource, QuebecClimateSeasonalResource};
use App\Models\{QuebecClimate, QuebecClimateSeasonal};

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

}
