<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuebecLegalAspect;
use App\Models\LegalAspectQuizCategory;
use App\Models\LegalAspectQuizOverview;
use App\DataTables\LegalAspectQuizOverviewDataTable;


class LegalAspectQuizOverviewController extends Controller
{
    public function index(LegalAspectQuizOverviewDataTable $dataTable, $id, $overview)
    {
        try {          
            $category = LegalAspectQuizCategory::with('quizOverviews')
                ->where('id', $overview)
                ->where('quebec_legal_aspect_id', $id)
                ->firstOrFail();   
                $dataTable->overview = $overview; 

            return $dataTable->render(
                'quebec.legal-aspects.quiz.overview.index',
                [
                    'id' => $id,
                    'overview' => $overview
                ]);
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index', ['id' => $id])
                ->with('error', 'Quiz Overview not found.');
        }
    }


    public function create($id,$overview)
    {
        try {
            return view('quebec.legal-aspects.quiz.overview.create',['id'=>$id,'overview'=>$overview]);

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.overview.index',['id',$id])->with('error','Quebec Legal Aspect Quiz Link not found');
        }
    }


    public function store(Request $request, $id,$overview)
    {
        try {
            // Validate the request
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
            $quiz = LegalAspectQuizCategory::findOrFail($overview);
            $existingOverview = $quiz->quizOverviews; 
            // dd($existingOverview);
            // if ($existingOverview) {
            //     dd("dd");
            //     $existingOverview->getoverviewLabels()->delete();
        
            //     $existingOverview->delete();
            // }
            // dd("hello before image");
            if($request->hasFile('featured_image')){
                $image = $request->file('featured_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = public_path('assets/legalAspectOverview');
                $image->move($imagePath,$imageName);

                //create image url
                $imageUrl= 'assets/legalAspectOverview/'. $imageName;
            }   
            // dd("after image");         
            // Create a new overview entry
            $quizoverview=LegalAspectQuizOverview::create([
                'legal_aspect_quiz_categories_id' => $overview,
                'featured_image' => $imageUrl ?? null,
                'title_question' => $validated['title_question'],
                'description' => $validated['description'],
            ]);
             // Store Labels and Label Images
             foreach ($validated['labels'] as $index => $label) {
                $labelImagePath = $request->file('label_images')[$index]->store('labels', 'public');
                $quizoverview->getoverviewLabels()->create([
                    'label' => $label,
                    'label_image' => $labelImagePath,
                ]);
            }

            // Redirect with success message
            return redirect()->route('quebec.legal-aspects.quiz.overview.index', ['id'=>$id,'overview'=>$overview])
                            ->with('success', 'Quiz Category Overview created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the quiz category overview: ' . $e->getMessage());
        }
    }

}
