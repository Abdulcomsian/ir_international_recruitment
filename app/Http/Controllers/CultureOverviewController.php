<?php

namespace App\Http\Controllers;

use App\Models\CultureQuiz;
use Illuminate\Http\Request;
use App\Models\CultureOverview;
use App\Models\CultureOverviewLabel;
use Illuminate\Support\Facades\Storage;
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
        // dd($quizId);
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

        $existingOverview = $quiz->overview; 
        if ($existingOverview) {
            $existingOverview->labels()->delete();
    
            $existingOverview->delete();
        }
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

    public function show($quizId)
    {
        $overview = CultureOverview::with('labels')->findOrFail($quizId);
        $quizID = $overview->culture_quiz_id;
        // dd($overview->toArray());
        
        // Check if the overview exists
        if (!$overview) {
            return redirect()->route('culture.quiz.index')
                ->with('error', 'Overview not found for this quiz.');
        }
        // Pass the overview data to the view
        return view('quebec.culture.quiz.overview.show', compact('overview','quizID'));
    }

    public function edit($id)
    {
        // dd($id);
        $overview = CultureOverview::with('labels')->findOrFail($id);
        // Pass the overview to the edit view
        return view('quebec.culture.quiz.overview.edit', compact('overview'));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'title_question' => 'required|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image',
            'labels' => 'sometimes|array',
            'labels.*' => 'sometimes|string|max:255',
            'label_images' => 'sometimes|array',
            'label_images.*' => 'sometimes|image',
            'delete_label_ids' => 'sometimes|array', // For labels to be deleted
        ]);

        $overview = CultureOverview::findOrFail($id);
        $overview->title_question = $validated['title_question'];
        $overview->description = $validated['description'];
        $cultureQuizid = $overview->culture_quiz_id;

        // Handle featured image (if provided)
        if ($request->hasFile('featured_image')) {
            if ($overview->featured_image) {
                Storage::disk('public')->delete($overview->featured_image);
            }
            $featuredImagePath = $request->file('featured_image')->store('featured_images', 'public');
            $overview->featured_image = $featuredImagePath;
        }

        $overview->save();

        $labels = $validated['labels'] ?? [];
        $labelImages = $request->file('label_images') ?? [];
        $existingLabels = $overview->labels;

        // Process provided labels
        foreach ($labels as $index => $label) {
            $labelImagePath = null;

            if (isset($labelImages[$index])) {
                // If a new image is uploaded, store it
                $labelImagePath = $labelImages[$index]->store('labels', 'public');
            }

            // Check if the label exists
            $existingLabel = $existingLabels->get($index);

            if ($existingLabel) {
                // Update existing label
                $existingLabel->update([
                    'label' => $label,
                    'label_image' => $labelImagePath ?? $existingLabel->label_image, // Retain old image if no new one is uploaded
                ]);
            } else {
                // Create a new label
                $overview->labels()->create([
                    'label' => $label,
                    'label_image' => $labelImagePath, // New image must be provided for new labels
                ]);
            }
        }

        // Handle label deletions
        if ($request->has('delete_label_ids')) {
            $deleteLabelIds = $validated['delete_label_ids'];

            // Delete associated images
            $labelsToDelete = $overview->labels()->whereIn('id', $deleteLabelIds)->get();
            foreach ($labelsToDelete as $labelToDelete) {
                if ($labelToDelete->label_image) {
                    Storage::disk('public')->delete($labelToDelete->label_image);
                }
            }

            // Delete labels from the database
            $overview->labels()->whereIn('id', $deleteLabelIds)->delete();
        }

        // Redirect with success message
        return redirect()
            ->route('culture.quiz.overview.index', ['id' => $cultureQuizid])
            ->with('success', 'Overview updated successfully!');
    }

    public function destroy($id)
    {
        $overview = CultureOverview::with('labels')->findOrFail($id);
        $quizId=$overview->culture_quiz_id;
        $overview->delete();
        return redirect()
            ->route('culture.quiz.overview.index', ['id' => $quizId])
            ->with('success', 'Overview updated successfully!');

    }










}
