<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{QuebecClimateResource, QuebecClimateSeasonalResource, QuebecClimatePackingListResource, QuebecClimateRecommendedActivityResource};
use App\Models\{QuebecClimate, QuebecClimatePackingList, QuebecClimateSeasonal, QuebecClimateRecommendedActivity};
use Illuminate\Support\Facades\Log;

class QuebecClimateController extends Controller
{

    public function index()
    {
        try {
            $quebecClimate = QuebecClimate::all();
            return QuebecClimateResource::collection($quebecClimate);

        } catch (\Throwable $th) {
            Log::error('Failed to retrieve Quebec Climate data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve Quebec Climate data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function seasonal($quebecClimateId)
    {
        try {
            $quebecClimateSeasonal = QuebecClimateSeasonal::with('quebecClimate')
                ->where('quebec_climate_id', $quebecClimateId)
                ->firstOrFail();

            return new QuebecClimateSeasonalResource($quebecClimateSeasonal);

        } catch (\Throwable $th) {
            Log::error('Failed to retrieve Quebec Climate seasonal data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve Quebec Climate seasonal data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function packingList($quebecClimateId)
    {
        try {
            $quebecClimatePackingList = QuebecClimatePackingList::with('quebecClimate')
                ->where('quebec_climate_id', $quebecClimateId)
                ->get();

            return QuebecClimatePackingListResource::collection($quebecClimatePackingList);

        } catch (\Throwable $th) {
            Log::error('Failed to retrieve Quebec Climate packing list data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve Quebec Climate packing list data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function recommendedActivities($quebecClimateId)
    {
        try {
            $quebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::with('quebecClimate')
                ->where('quebec_climate_id', $quebecClimateId)
                ->get();

            return QuebecClimateRecommendedActivityResource::collection($quebecClimateRecommendedActivity);

        } catch (\Throwable $th) {
            Log::error('Failed to retrieve Quebec Climate recommended activities: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve Quebec Climate recommended activities.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

}
