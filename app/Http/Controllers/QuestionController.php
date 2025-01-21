<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\CultureQuiz;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\DataTables\CultureQuestionDataTable;

class QuestionController extends Controller
{
    public function index(CultureQuestionDataTable $dataTable,  $id)
    {
        try{
            $quiz = CultureQuiz::findOrFail($id); 
            $dataTable->quizId = $id; 
            return $dataTable->render('quebec.culture.quiz.question.index', compact('quiz'));
        }catch(\Exception $e){
            return redirect()->route('culture.quiz.questions.index', $id)->with('error', 'Issue!');
        }
        
    }

    public function create($id)
    {
        try{
            $quiz = CultureQuiz::findOrFail($id);
            return view('quebec.culture.quiz.question.create', compact('quiz'));
        }catch(\Exception){
            return redirect()->route('culture.quiz.questions.index', $id)->with('error', 'Issue Occured!');
        }
    }

    public function store(Request $request, $quizId)
    {
        try{
            $validated = $request->validate([
                'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'question_text' => 'required|string|max:255',
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
            $question = Question::create([
                'featured_image' => $imageUrl ?? null,
                'culture_quiz_id' => $quizId,
                'question_text' => $validated['question_text'],
            ]);
    
            // Create the options and associate the correct option
            foreach ($validated['options'] as $index => $optionText) {
                $option = Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $optionText,
                    'is_correct' => ($index == $validated['correct_option']),
                ]);
            }
    
            return redirect()->route('culture.quiz.questions.index', $quizId)->with('success', 'Question added successfully!');
        }catch(\Exception $e){
            return redirect()->route('culture.quiz.questions.index', $quizId)->with('error', 'Issue Occured!');
        }
    }

    public function show($id)
    {
        try{
            $question = Question::with('options')->findOrFail($id);
            $quizID = $question->culture_quiz_id;
    
            // dd($question->toArray());
            // Check if the overview exists
            if (!$question) {
                return redirect()->route('culture.quiz.index')
                    ->with('error', 'Overview not found for this quiz.');
            }
            // Pass the overview data to the view
            return view('quebec.culture.quiz.question.show', compact('question','quizID'));
        }catch(\Exception $e){
            return redirect()->route('culture.quiz.questions.index', $quizId)->with('error', 'Issue Occured!');
        }
       
    }

    public function edit($id)
    {
        try{
            $question = Question::with('options')->findOrFail($id);
            // dd($question->toArray());
            $quizId = $question->culture_quiz_id;

            $quiz = CultureQuiz::where('id',$quizId)->first();
            return view('quebec.culture.quiz.question.edit', compact('question','quiz'));

        }catch(\Exception $e){
            return redirect()->route('culture.quiz.questions.index', $quizId)->with('error', 'Issue Occured!');
        }
    }

    public function update(Request $request, $questionId)
    {
        try{
            $request->validate([
                'featured_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'question_text' => 'required|string',
                'options.*.answer_text' => 'required|string',
                'correct_option' => 'required',
            ]);
    
            $question = Question::findOrFail($questionId);
    
            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/questionImages');
                $image->move($imagePath, $imageName);
    
                $imageUrl = 'assets/questionImages/' . $imageName;
                $question->update(['featured_image' => $imageUrl]);
            }
    
            $question->update(['question_text' => $request->question_text]);
    
            // Handle options
            $currentOptionIds = $question->options->pluck('id')->toArray();
            $newOptionIds = array_keys($request->options);
            $toDelete = array_diff($currentOptionIds, $newOptionIds);
            Answer::whereIn('id', $toDelete)->delete();
    
            foreach ($request->options as $id => $data) {
                Answer::updateOrCreate(
                    ['id' => is_numeric($id) ? $id : null],
                    [
                        'question_id' => $question->id,
                        'answer_text' => $data['answer_text'],
                        'is_correct' => $id == $request->correct_option,
                    ]
                );
            }
    
            return redirect()->route('culture.quiz.questions.index', $question->culture_quiz_id)
                ->with('success', 'Question updated successfully!');

        }catch(\Exception $e){
            return redirect()->route('culture.quiz.questions.index', $question->culture_quiz_id)->with('error', 'Issue Occured!');

        }
        
    }


    public function update1(Request $request,$questionId)
    {
        $request->validate([
            'featured_image' => 'ssometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'question_text' => 'required|string',
            'options.*.answer_text' => 'required|string',
            'correct_option' => 'required',
        ]);

        $question = Question::findOrFail($questionId);
        $quizID = CultureQuiz::where('id',$question->culture_quiz_id)->first();
        // dd($quizID);
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('assets/questionImages', 'public');
            $question->update(['featured_image' => $imagePath]);
        }

        $question->update(['question_text' => $request->question_text]);

        foreach ($request->options as $id => $data) {
            Answer::updateOrCreate(
                ['id' => $id],
                [
                    'question_id' => $question->id,
                    'answer_text' => $data['answer_text'],
                    'is_correct' => $id == $request->correct_option,
                ]
            );
        }

        return redirect()->route('culture.quiz.questions.index', $quizID->id)->with('success', 'Question updated successfully!');
    }

    public function destroy($id)
    {
        $question = Question::with('options')->findOrFail($id);
        $quizId = $question->culture_quiz_id;
        $question->delete();
        return redirect()->route('culture.quiz.questions.destroy', ['id' => $quizId]);

    }
}
