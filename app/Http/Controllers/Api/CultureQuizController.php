<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use App\Models\CultureQuiz;
use Illuminate\Http\Request;
use App\Models\CultureQuizResult;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            'overview.labels', 
            'questions.options' => function($query) {
                $query->select('id', 'answer_text', 'is_correct', 'question_id');
            }
        ])
        ->findOrFail($id);
        // return new CultureQuizResource($quiz);

        return response()->json([
            'msg'=> 'Data Fetched Successfully',
            'status'=> true,
            'data' => $quiz
        ],200);
    }

    public function getQuestions($id)
    {
        $quiz=Question::with('options')->where('id',$id)->get();
        return response()->json([
            'msg'=> 'Data Fetched Successfully',
            'status'=> true,
            'data' => $quiz
        ],200);
    }

    public function submitAnswer($id, Request $request)
    {
        $request->validate([
            'selected_option_id'=> 'required'
        ]);
        $question = Question::with('options')->findOrFail($id);

        $selectedOption = $question->options->firstWhere('id', $request->selected_option_id);

        if (!$selectedOption) {
            return response()->json(['error' => 'Invalid option selected'], 400);
        }
        $isCorrect = $selectedOption->is_correct;

        return response()->json([
            'is_correct' => $isCorrect,
            'message' => $isCorrect ? 'Correct answer!' : 'Incorrect answer.',
            'data' => $selectedOption
        ]);

    }

    public function submitAnswers(Request $request)
    {
        // {
        //     "answers": [
        //         {
        //             "question_id": 1,
        //             "selected_option_id": 101
        //         },
        //         {
        //             "question_id": 2,
        //             "selected_option_id": 202
        //         }
        //     ]
        // }
        
        $request->validate([
            'answers' => 'required|array|min:1',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.selected_option_id' => 'required|exists:answers,id',
        ]);

        $results = [];
        foreach ($request->answers as $answer) {
            // Retrieve the question and its options
            $question = Question::with('options')->find($answer['question_id']);
            
            if (!$question) {
                $results[] = [
                    'question_id' => $answer['question_id'],
                    'is_correct' => null,
                    'message' => 'Question not found.',
                ];
                continue;
            }

            // Find the selected option
            $selectedOption = $question->options->firstWhere('id', $answer['selected_option_id']);

            if (!$selectedOption) {
                $results[] = [
                    'question_id' => $answer['question_id'],
                    'is_correct' => null,
                    'message' => 'Invalid option selected.',
                ];
                continue;
            }

            // Check if the answer is correct
            $isCorrect = $selectedOption->is_correct;

            $results[] = [
                'question_id' => $answer['question_id'],
                'is_correct' => $isCorrect,
                'message' => $isCorrect ? 'Correct answer!' : 'Incorrect answer.',
            ];
        }

        // Return the results for each question
        return response()->json([
            'results' => $results,
            'message' => 'Answers submitted successfully!',
        ]);
    }

    public function storeResult(Request $request, $id)
    {
        try{
            $culture = CultureQuiz::find($id);
            if(!$culture)
            {
                return response()->json([
                    'message' => 'Quiz Culture Not Found!',
                ]);
    
            }
            $user = Auth::user()->id;
            $result =new CultureQuizResult;
            $result->user_id = $user;
            $result->culture_quiz_id = $id;
            $result->total_questions = $request->total_questions;
            $result->correct_answers = $request->correct_answers;
            $result->save();
    
            return response()->json([
                'message' => 'Quiz Result Submitted Successully!',
                'data' => $result
            ]);
    
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Issue Occured!',
                'error' => $e->getMessage()
            ]);
        }
        
        
    }

}
