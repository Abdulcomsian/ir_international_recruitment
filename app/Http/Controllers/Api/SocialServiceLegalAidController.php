<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialServiceLegalAidResource;
use App\Models\SocialServiceLegalAid;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SocialServiceLegalAidController extends Controller
{
    public function index(Request $request)
    {
        try {

            $cityId = $request->city ?? '';

            $socialServiceLegalAids = SocialServiceLegalAid::when(!empty($cityId), function ($query) use ($cityId) {
                $query->where('city_id', $cityId);
            })
            ->with('city')
            ->get();

            return SocialServiceLegalAidResource::collection($socialServiceLegalAids);

        } catch (\Throwable $th) {
            Log::error('Failed to retrieve social service legal aids data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve social service legal aids data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
