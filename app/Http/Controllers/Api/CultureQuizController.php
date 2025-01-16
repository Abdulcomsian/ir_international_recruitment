<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CultureQuiz;
use App\Http\Resources\CultureQuizResource;

class CultureQuizController extends Controller
{
    public function getCultureList()
    {
        // dd();
        try{
            $culture = CultureQuiz::all();
            return CultureQuizResource::collection($culture);
        }catch(\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve Cities data.',
                'error' => $e->getMessage()
            ], 500);
        }       
        
    }
}
