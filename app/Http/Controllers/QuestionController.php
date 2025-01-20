<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\CultureQuiz;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\CultureQuestionDataTable;

class QuestionController extends Controller
{
    public function index(CultureQuestionDataTable $dataTable,  $id)
    {
        // Fetch the quiz based on ID
        $quiz = CultureQuiz::findOrFail($id); 
        // Fetch the quiz based on the ID

        $dataTable->quizId = $id; 
        
        return $dataTable->render('quebec.culture.quiz.question.index', compact('quiz'));
    }

    public function create($id)
    {
        $quiz = CultureQuiz::findOrFail($id);
        return view('quebec.culture.quiz.question.create', compact('quiz'));
    }

    public function store(Request $request, $quizId)
    {
        
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
    }

    public function show($id)
    {
        $question = Question::with('options')->findOrFail($id);
        $quizID = $question->culture_quiz_id;

        // Check if the overview exists
        if (!$question) {
            return redirect()->route('culture.quiz.index')
                ->with('error', 'Overview not found for this quiz.');
        }
        // Pass the overview data to the view
        return view('quebec.culture.quiz.question.show', compact('overview','quizID'));

    }
}
