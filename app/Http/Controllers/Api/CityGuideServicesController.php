<?php

namespace App\Http\Controllers\Api;

use App\Models\CityService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityGuideServiceResource;

class CityGuideServicesController extends Controller
{
    public function getServices()
    {
        try{
            $service = CityService::all();
            return CityGuideServiceResource::collection($service);
        }catch(\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve services data.',
                'error' => $e->getMessage()
            ], 500);
        } 
    }
}
