<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuebecFoodResource;
use App\Models\QuebecFood;
use Illuminate\Support\Facades\Log;

class QuebecFoodController extends Controller
{
    public function index()
{
    try {
        $quebecFood = QuebecFood::all();
        return QuebecFoodResource::collection($quebecFood);

    } catch (\Throwable $th) {
        Log::error('Failed to retrieve Quebec Food data: ' . $th->getMessage());
        return response()->json([
            'message' => 'Failed to retrieve Quebec Food data.',
            'error' => $th->getMessage()
        ], 500);
    }
}

}
