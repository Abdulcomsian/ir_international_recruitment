<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegalAspectQuizCategory;
use App\DataTables\LegalAspectQuestionDataTable;
use App\Models\LegalAspectQuestion;
use App\Models\LegalQuizOption;
use Illuminate\Validation\Rule;

class LegalAspectQuestionController extends Controller
{
    public function index(LegalAspectQuestionDataTable $dataTable, $id, $overview)
    {
        try {     
            $category = LegalAspectQuizCategory::with('quizQuestions')
                ->where('id', $overview)
                ->where('quebec_legal_aspect_id', $id)
                ->firstOrFail();   
                $dataTable->overview = $overview; 


            return $dataTable->render(
                'quebec.legal-aspects.quiz.question.index',['id' => $id, 'overview' => $overview ]);
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index', ['id' => $id])
                ->with('error', 'Quiz Overview not found.');
        }
    }

    public function create($id,$overview)
    {
        try {
            return view('quebec.legal-aspects.quiz.question.create',['id'=>$id,'overview'=>$overview]);

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.question.index',['id',$id])->with('error','Quebec Legal Aspect Quiz Questions not found');
        }
    }

    public function store(Request $request, $id,$overview)
    {
        try{
            $validated = $request->validate([
                'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'question_text' => 'required|string|max:255',
                'question_type' => 'required|in:simple,true/false',
                'options' => 'required|array|min:2',
                'options.*' => 'required|string|max:255', 
                'correct_option' => [
                                    'required',
                                    'integer',
                                    Rule::in(range(0, count($request->options) - 1)),
                                ],
            ]);
            $imageUrl = null;
            if($request->hasFile('featured_image'))
            {
                $image = $request->file('featured_image');
                $imageName = time(). '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/questionImages');
                $image->move($imagePath,$imageName);
    
                $imageUrl = 'assets/questionImages/' . $imageName;
            }
            // Create the question
            $question = LegalAspectQuestion::create([
                'featured_image' => $imageUrl ?? null,
                'legal_aspect_quiz_categories_id' => $overview,
                'question_text' => $validated['question_text'],
                'question_type' => $validated['question_type'],

            ]);
    
            // Create the options and associate the correct option
            foreach ($validated['options'] as $index => $optionText) {
                $option = LegalQuizOption::create([
                    'legal_aspect_questions_id' => $question->id,
                    'answer_text' => $optionText,
                    'is_correct' => ($index == $validated['correct_option']),
                ]);
            }

            return redirect()->route('quebec.legal-aspects.quiz.question.index', ['id'=>$id,'overview'=>$overview])->with('success', 'Question added successfully!');
        }catch(\Exception $e){
            return redirect()->route('quebec.legal-aspects.quiz.question.index', ['id'=>$id,'overview'=>$overview])->with('error', 'Issue Occured!');
        }
    }

   

    public function show($id,$overview)
    {
        try{
            // dd(['id'=>$id, 'overview'=> $overview]);
            // $overview is question id
            $question = LegalAspectQuestion::with('getoptions')->findOrFail($overview);
            // $quizID = $question->culture_quiz_id;
    
            // dd($question->toArray());
            // Check if the overview exists
            if (!$question) {
                return redirect()->route('quebec.legal-aspects.quiz.question.index',['id' => $id, 'overview' => $overview ])
                    ->with('error', 'question not found for this quiz.');
            }
            // Pass the overview data to the view
            return view('quebec.legal-aspects.quiz.question.show',['id'=>$id,'overview'=>$overview,'question'=>$question]);

        }catch(\Exception $e){
            return redirect()->route('quebec.legal-aspects.quiz.question.index', ['id' => $id, 'overview' => $overview ])->with('error', 'Issue Occured!');
        }
       
    }

    public function destroy($id,$overview)
    {
        // dd($id,$overview);
        $question = LegalAspectQuestion::with('getoptions')->findOrFail($overview);
        $questionsiD=$question->legal_aspect_quiz_categories_id;
        // dd($questionsiD);
        $question->delete();
        return redirect()->route('quebec.legal-aspects.quiz.question.index', ['id' => $id, 'overview' => $questionsiD ])->with('error', 'Issue Occured!');
    }
}
