<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuebecFoodResource;
use App\Models\QuebecFood;

class QuebecFoodController extends Controller
{
    public function index()
    {

        $quebecFood = QuebecFood::all();

        return QuebecFoodResource::collection($quebecFood);

    }
}
