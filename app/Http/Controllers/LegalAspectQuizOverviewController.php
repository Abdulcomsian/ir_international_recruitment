<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuebecLegalAspect;
use App\Models\LegalAspectQuizCategory;
use App\Models\LegalAspectQuizOverview;
use App\DataTables\LegalAspectQuizOverviewDataTable;


class LegalAspectQuizOverviewController extends Controller
{
    public function index1(LegalAspectQuizOverviewDataTable $dataTable,$id,$overview)
    {
            try {            
                $quebecLegalAspect = QuebecLegalAspect::with('legalAspectQuiz')->where('type', 'quiz')->findOrFail($id);
                // dd($quebecLegalAspect->toArray());
                // $categoryId = $quebecLegalAspect->legal_aspect_quiz->id;
                // dd($categoryId);
                return $dataTable->render('quebec.legal-aspects.quiz.overview.index',compact('quebecLegalAspect'));
    
            } catch (\Exception $e) {
                return redirect()->route('quebec.legal-aspects.index')->with('error','Quebec Legal Aspect Quiz not found');
            }
    }

    public function index(LegalAspectQuizOverviewDataTable $dataTable, $id, $overview)
    {
        try {
            // Fetch the specific legal aspect and its quiz category overview
            $category = LegalAspectQuizCategory::with('quizOverviews')
                ->where('id', $overview)
                ->where('quebec_legal_aspect_id', $id)
                ->firstOrFail();

            return $dataTable->render('quebec.legal-aspects.quiz.overview.index', compact('category'));
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index', ['id' => $id])
                ->with('error', 'Quiz Overview not found.');
        }
    }


    public function create($id)
    {
        try {
            // dd($id);
            $quebecLegalAspect = QuebecLegalAspect::where('type', 'quiz')->findOrFail($id);
            return view('quebec.legal-aspects.quiz.overview.create',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.overview.index',$id)->with('error','Quebec Legal Aspect Quiz Link not found');
        }
    }

    public function store(Request $request, $quizId)
{
    try {
        // Validate the request
        $validated = $request->validate([
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('legalAspectsQuiz', 'public');
        }

        // Create a new overview entry
        LegalAspectQuizOverview::create([
            'quebec_legal_aspect_id' => $quizId,
            'featured_image' => $imagePath,
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // Redirect with success message
        return redirect()->route('quebec.legal-aspects.quiz.index', $quizId)
                         ->with('success', 'Quiz Category Overview created successfully!');
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while creating the quiz category overview: ' . $e->getMessage());
    }
}

}
