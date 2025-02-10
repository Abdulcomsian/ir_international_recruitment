<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransportationResource;
use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransportationController extends Controller
{
    public function index(Request $request)
    {

        try {

            $cityId = $request->city ?? '';

            dd($cityId);

            $transportations = Transportation::when(!empty($cityId), function ($query) use ($cityId) {
                $query->where('city_id', $cityId);
            })->with('city')->get();

            return TransportationResource::collection($transportations);

        } catch (\Throwable $th) {
            Log::error('Failed to retrieve transportations data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve transportations data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
