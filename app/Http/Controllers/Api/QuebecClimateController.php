<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuebecClimateResource;
use App\Models\QuebecClimate;

class QuebecClimateController extends Controller
{

    public function index()
    {

        $quebecClimate = QuebecClimate::all();

        return QuebecClimateResource::collection($quebecClimate);

    }

}
