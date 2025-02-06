<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuebecLegalAspect;
use App\Models\LegalAspectQuizCategory;
use App\Models\LegalAspectQuizOverview;
use App\DataTables\LegalAspectQuizOverviewDataTable;
use Storage;

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
            if ($existingOverview) {
                $existingOverview->getoverviewLabels()->delete();
        
                $existingOverview->delete();
            }
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

    public function edit($id,$quiz)
    {
        try {
            $overview = LegalAspectQuizOverview::findOrFail($quiz);
            return view('quebec.legal-aspects.quiz.overview.edit',['id'=>$id,'overview'=>$overview]);

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.overview.index',['id',$id])->with('error','Quebec Legal Aspect Quiz Link not found');
        }
    }

    public function update(Request $request, $id, $overviewId)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'featured_image' => 'nullable|image',
                'title_question' => 'required|string|max:255',
                'description' => 'required|string',
                'labels' => 'required|array',
                'labels.*' => 'required|string|max:255',
                'label_images' => 'nullable|array',
                'label_images.*' => 'nullable|image',
            ]);

            $quiz = LegalAspectQuizCategory::findOrFail($id);
            $overview = LegalAspectQuizOverview::findOrFail($overviewId);

            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/legalAspectOverview');
                $image->move($imagePath, $imageName);

                // Delete old image
                if ($overview->featured_image) {
                    @unlink(public_path($overview->featured_image));
                }

                $overview->featured_image = 'assets/legalAspectOverview/' . $imageName;
            }

            // Update overview fields
            $overview->update([
                'title_question' => $validated['title_question'],
                'description' => $validated['description'],
            ]);

            // Delete old labels
            $overview->getoverviewLabels()->delete();

            // Store new labels and label images
            foreach ($validated['labels'] as $index => $label) {
                $labelImagePath = $request->hasFile('label_images') && isset($request->file('label_images')[$index])
                    ? $request->file('label_images')[$index]->store('labels', 'public')
                    : $overview->getoverviewLabels[$index]->label_image ?? null;

                $overview->getoverviewLabels()->create([
                    'label' => $label,
                    'label_image' => $labelImagePath,
                ]);
            }

            return redirect()->route('quebec.legal-aspects.quiz.overview.index', ['id' => $id, 'overview' => $overviewId])
                            ->with('success', 'Quiz Category Overview updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating the quiz category overview: ' . $e->getMessage());
        }
    }

    public function show($id, $overview)
    {
        try {
            // dd([$id,$overview]);
            $quiz = LegalAspectQuizOverview::with('getoverviewLabels')->findOrFail($overview);

            // Pass the $id and $quiz to the view
            return view('quebec.legal-aspects.quiz.overview.show', compact('quiz', 'id','overview'));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while fetching the quiz overview: ' . $e->getMessage());
        }
    }

    public function destroy($id, $overviewId)
    {
        try {
            $overview = LegalAspectQuizOverview::with('getoverviewLabels')->findOrFail($overviewId);

            if ($overview->featured_image && Storage::exists(public_path($overview->featured_image))) {
                @unlink(public_path($overview->featured_image));
            }

            // Delete associated labels and their images
            foreach ($overview->getoverviewLabels as $label) {
                if ($label->label_image && \Storage::exists('public/' . $label->label_image)) {
                    \Storage::delete('public/' . $label->label_image);
                }
                $label->delete(); 
            }

                $overview->delete();

            return redirect()->route('quebec.legal-aspects.quiz.overview.index', ['id' => $id])
                            ->with('success', 'Quiz Overview and its associated data have been deleted successfully!');
        } catch (\Exception $e) {
            // Handle errors and redirect back with an error message
            return back()->with('error', 'An error occurred while deleting the quiz overview: ' . $e->getMessage());
        }
    }


}
