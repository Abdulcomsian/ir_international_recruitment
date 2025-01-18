<?php

namespace App\Http\Controllers;

use App\Models\CultureQuiz;
use App\Models\Question;
use App\Models\Answer;

use Illuminate\Http\Request;
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
            'question_text' => 'required|string|max:255',
            'options' => 'required|array|min:2', // At least 2 options required
            'options.*' => 'required|string|max:255', // Each option should be a string
            'correct_option' => 'required|integer|in:0,' . (count($request->options) - 1), // Correct option index
        ]);

        // Create the question
        $question = Question::create([
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
}
