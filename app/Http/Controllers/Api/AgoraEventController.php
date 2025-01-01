<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgoraEventResource;
use App\Models\AgoraEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AgoraEventController extends Controller
{
    public function index(Request $request)
    {
        try {

            $location = $request->location ?? '';

            $agoraEvents = AgoraEvent::when(!empty($location), function ($query) use ($location) {
                $query->where('location', 'like', '%' . $location . '%');
            })->get();

            return AgoraEventResource::collection($agoraEvents);
        } catch (\Throwable $th) {
            Log::error('Failed to retrieve Agora Events data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve Agora Events data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
