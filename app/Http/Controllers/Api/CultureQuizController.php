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

    public function getQuizDetails($id)
    {
        // dd();
        // Retrieve the quiz with all its relationships (overview, questions, answers)
        $quiz = CultureQuiz::with([
            'overview', 
            'questions.options' => function($query) {
                $query->select('id', 'answer_text', 'is_correct', 'question_id');
            }
        ])
        ->findOrFail($id);

        return response()->json([
            'msg'=> 'Data Fetched Successfully',
            'status'=> true,
            'data' => $quiz
        ],200);
    }
}
