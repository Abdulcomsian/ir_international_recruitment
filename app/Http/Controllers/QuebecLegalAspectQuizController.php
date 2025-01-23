<?php

namespace App\Http\Controllers;

use App\DataTables\LegalAspectQuizCategoryDataTable;
use Illuminate\Http\Request;
use App\Models\QuebecLegalAspect;
use App\Models\LegalAspectQuizCategory;
use App\Http\Requests\LegalQuizCategory\{StoreRequest,UpdateRequest};

class QuebecLegalAspectQuizController extends Controller
{
    public function index(LegalAspectQuizCategoryDataTable $dataTable,$id)
    {
        try {
            
            $quebecLegalAspect = QuebecLegalAspect::where('type', 'quiz')->findOrFail($id);
            return $dataTable->render('quebec.legal-aspects.quiz.index',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error','Quebec Legal Aspect Quiz not found');
        }
    }

    public function create($id)
    {
        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'quiz')->findOrFail($id);
            return view('quebec.legal-aspects.quiz.create',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('error','Quebec Legal Aspect Quiz Link not found');
        }
    }

    public function show404($id)
    {
        try {
            dd($id);
            $quebecLegalAspect = LegalAspectQuizCategory::where('quebec_legal_aspect_id', '$id')->first();
            dd($quebecLegalAspect);
            return view('quebec.legal-aspects.quiz.show',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('error','Quebec Legal Aspect Quiz Link not found');
        }

    }

    public function store(StoreRequest $request, $id)
    {
        try {
            // dd($request->all());
            if($request->hasFile('featured_image')){
                $image = $request->file('featured_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = public_path('assets/legalAspectsQuiz');
                $image->move($imagePath,$imageName);

                //create image url
                $imageUrl= 'assets/legalAspectsQuiz/'. $imageName;
            }
            LegalAspectQuizCategory::create([
                'quebec_legal_aspect_id' => $id,
                'featured_image' => $imageUrl ?? Null,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('success', 'Legal Aspects Quiz created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('error', 'Issue Occured');
        }
    }

    public function edit($id, $quebecLegalAspectQuizId)
    {
        try {
            $quebecLegalAspectQuiz = LegalAspectQuizCategory::with('quebecLegalAspect')->findOrFail($quebecLegalAspectQuizId);
            // dd($quebecLegalAspectQ   uiz);

            return view('quebec.legal-aspects.quiz.edit', compact('quebecLegalAspectQuiz'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('error', 'Quiz not found');
        }

    }

    public function show($id, $quebecLegalAspectQuizId)
    {
        try {
            $quebecLegalAspect = LegalAspectQuizCategory::with('quebecLegalAspect')->findOrFail($quebecLegalAspectQuizId);
            return view('quebec.legal-aspects.quiz.show', compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('error', 'Quiz not found');
        }

    }

    public function update(UpdateRequest $request, $id, $quebecLegalAspectQuizId)
    {
        try {
            $quebecLegalAspectQuiz = LegalAspectQuizCategory::with('quebecLegalAspect')->findOrFail($quebecLegalAspectQuizId);

            if ($request->hasFile('featured_image')) {
                // remove Old img
                $this->unlinkFile($quebecLegalAspectQuiz->featured_image);
                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/cultureQuiz');
                $image->move($imagePath, $imageName);
    
                $media_url = 'assets/cultureQuiz/' . $imageName;
    
            } 

            $quebecLegalAspectQuiz->featured_image = $media_url ?? $quebecLegalAspectQuiz->featured_image;
            $quebecLegalAspectQuiz->title = $request->title;
            $quebecLegalAspectQuiz->description =  $request->description;

            $quebecLegalAspectQuiz->save();

            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('success', 'Quiz updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('error', 'error');
        }
    }

    public function destroy($id, $quebecLegalAspectQuizId)
    {
        try {
            $quebecLegalAspectQuiz = LegalAspectQuizCategory::findOrFail($quebecLegalAspectQuizId);
            $quebecLegalAspectQuiz->delete();
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('success', 'Quiz deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.quiz.index',$id)->with('error', 'An error occurred while deleting');
        }

    }


}
