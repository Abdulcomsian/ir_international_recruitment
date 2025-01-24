<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\LegalAspectQuestion;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LegalAspectQuizResult;
use App\Models\LegalAspectQuizCategory;
use App\Models\{QuebecLegalAspect, QuebecLegalAspectFaq, QuebecLegalAspectNavigation, QuebecLegalAspectUsefulLink, QuebecLegalAspectAid};
use App\Http\Resources\{QuebecLegalAspectResource, QuebecLegalAspectNavigationResource, QuebecLegalAspectFaqResource, QuebecLegalAspectUsefulLinkResource, QuebecLegalAspectAidResource};

class QuebecLegalAspectController extends Controller
{

    public function index()
    {
        try {
            $quebecLegalAspect = QuebecLegalAspect::all();
            return QuebecLegalAspectResource::collection($quebecLegalAspect);
        } catch (\Throwable $th) {
            Log::error('Failed to retrieve legal aspects: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve legal aspects data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function navigations()
    {
        try {
            $quebecLegalAspectNavigations = QuebecLegalAspectNavigation::with('quebecLegalAspect')->get();
            return QuebecLegalAspectNavigationResource::collection($quebecLegalAspectNavigations);
        } catch (\Throwable $th) {
            Log::error('Failed to retrieve navigation data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve navigation data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function faqs()
    {
        try {
            $quebecLegalAspectFaqs = QuebecLegalAspectFaq::with('quebecLegalAspect')->get();
            return QuebecLegalAspectFaqResource::collection($quebecLegalAspectFaqs);
        } catch (\Throwable $th) {
            Log::error('Failed to retrieve FAQ data: ' . $th->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve FAQ data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function usefulLinks()
    {

        try {

            $quebecLegalAspectUsefulLinks = QuebecLegalAspectUsefulLink::with('quebecLegalAspect')->get();

            return QuebecLegalAspectUsefulLinkResource::collection($quebecLegalAspectUsefulLinks);
        } catch (\Throwable $th) {
            // Log the error for debugging if needed
            Log::error('Failed to retrieve useful links: ' . $th->getMessage());

            return response()->json([
                'message' => 'Failed to retrieve useful links data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function legalAids(Request $request)
    {
        try {

            $cityId = $request->city ?? '';

            $quebecLegalAspectAids = QuebecLegalAspectAid::when(!empty($cityId), function ($query) use ($cityId) {
                $query->where('city_id', $cityId);
            })->with(['quebecLegalAspect','city'])->get();

            return QuebecLegalAspectAidResource::collection($quebecLegalAspectAids);
        } catch (\Throwable $th) {
            // Log the error for debugging if needed
            Log::error('Failed to retrieve legal aids: ' . $th->getMessage());

            return response()->json([
                'message' => 'Failed to retrieve legal aids data.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function quiz(Request $request) //here get the quiz, quiz categories and it overview with labels
    {
       $legalQuiz =  QuebecLegalAspect::with('legalAspectQuiz.quizOverviews.getoverviewLabels')->where('type','quiz')->get();
       return response()->json([
        'msg'=> 'Data Fetched Successfully',
        'status'=>true,
        'data'=> $legalQuiz
       ]);
    }

    public function questions($id) //get all questions of a specific category
    {
        $questions = LegalAspectQuestion::with('getoptions')->where('legal_aspect_quiz_categories_id',$id)->get();
        return response()->json([
            'msg'=> 'Questions Data Fetched Successfully',
            'status'=>true,
            'data'=> $questions
           ]);
    }

    public function submitAnswer($id, Request $request)
    {
        $request->validate([
            'selected_option_id'=> 'required'
        ]);
        $question = LegalAspectQuestion::with('getoptions')->findOrFail($id);

        $selectedOption = $question->getoptions->firstWhere('id', $request->selected_option_id);

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

    public function storeResult(Request $request, $id)
    {
        try{
            $culture = LegalAspectQuizCategory::find($id);
            if(!$culture)
            {
                return response()->json([
                    'message' => 'Quiz Culture Not Found!',
                ]);
    
            }
            $user = Auth::user()->id;
            $result =new LegalAspectQuizResult;
            $result->user_id = $user;
            $result->legal_aspect_quiz_categories_id = $id;
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
                'error'=> $e->getMessage(),
            ]);
        }
        
        
    }
}
