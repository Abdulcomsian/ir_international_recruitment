<?php

namespace App\Http\Controllers;

use App\Models\CultureQuiz;
use Illuminate\Http\Request;
use App\Models\CultureOverview;
use App\Models\CultureOverviewLabel;
use App\DataTables\CultureOverviewDataTable;

class CultureOverviewController extends Controller
{
    public function index(CultureOverviewDataTable $dataTable, $id)
    {
        $quiz = CultureQuiz::findOrFail($id); 
        // Fetch the quiz based on the ID

        $dataTable->quizId = $id; 

        return $dataTable->render('quebec.culture.quiz.overview.index', compact('quiz'));
    }


    public function create($id)
    {
        $quiz = CultureQuiz::findOrFail($id);
        return view('quebec.culture.quiz.overview.create', compact('quiz'));
    }

    public function store(Request $request, $quizId)
    {
        $validated = $request->validate([
            'featured_image' => 'required|image', // Validate as an image
            'title_question' => 'required|string|max:255',
            'description' => 'required|string',
            'labels' => 'required|array',
            'labels.*' => 'required|string|max:255',
            'label_images' => 'required|array',
            'label_images.*' => 'required|image',
        ]);

        // Ensure the quiz exists
        $quiz = CultureQuiz::findOrFail($quizId);

        // Handle the featured image
        $featuredImagePath = $request->file('featured_image')->store('featured_images', 'public');

        // Create the overview
        $overview = CultureOverview::create([
            'culture_quiz_id' => $quiz->id,
            'title_question' => $validated['title_question'],
            'description' => $validated['description'],
            'featured_image' => $featuredImagePath, // Save the featured image path
        ]);

        // Store Labels and Label Images
        foreach ($validated['labels'] as $index => $label) {
            $labelImagePath = $request->file('label_images')[$index]->store('labels', 'public');
            $overview->labels()->create([
                'label' => $label,
                'label_image' => $labelImagePath,
            ]);
        }

            // Redirect after creation with the quizId parameter
            return redirect()->route('culture.quiz.overview.index', ['id' => $quiz->id])
            ->with('success', 'Overview created successfully!');   
    }







}
