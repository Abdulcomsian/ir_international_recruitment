<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\City\CityTypeRequest;

class CityController extends Controller
{
    public function __invoke(CityTypeRequest $request)
    {
        try {

            $type = $request->type;

            $cities = City::when($type === 'legalAids' && $type !== 'all', function ($query) {
                $query->has('legalAid');
            })->get();

            return CityResource::collection($cities);

        } catch (\Throwable $th) {
            Log::error('Failed to retrieve Cities data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve Cities data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
