<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CultureQuizDataTable;
use App\Http\Requests\CultureQuiz\{StoreRequest, UpdateRequest};
use App\Models\CultureQuiz;

class CultureQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CultureQuizDataTable $dataTable)
    {
        return $dataTable->render('quebec.culture.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('quebec.culture.create');
        }catch(\Exception $e){
            return redirect()->route('quebec.culture.index')->with('error','An error occurred while creating quiz');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            if($request->hasFile('featured_image')){
                $image = $request->file('featured_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = public_path('assets/cultureQuiz');
                $image->move($imagePath,$imageName);

                //create image url
                $imageUrl= 'assets/cultureQuiz/'. $imageName;
            }
            CultureQuiz::create([
                'title' => $request->title,
                'featured_image' => $imageUrl ?? Null,
                'description' => $request->description,
            ]);

            return redirect()->route('culture.quiz.index')->with('success', 'Questions created successfully');
        } catch (\Exception $e) {
            return redirect()->route('culture.quiz.index')->with('error', 'An error occured while creating Questions');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $quiz =  CultureQuiz::find($id);
            return view('quebec.culture.show', compact('quiz'));
        }catch(\Exception $e){
            return redirect()->route('culture.quiz.index')->with('error', 'An error occured while Viewing City');

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {

            $quiz = CultureQuiz::findOrFail($id);
            // dd($quiz);
            return view('quebec.culture.edit', compact('quiz'));

        } catch (\Exception $e) {
            return redirect()->route('culture.quiz.index')->with('error', 'Quiz not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try {
            $quiz = CultureQuiz::findOrFail($id);

            if ($request->hasFile('featured_image')) {
                // remove Old img
                $this->unlinkFile($quiz->featured_image);
                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/cultureQuiz');
                $image->move($imagePath, $imageName);
    
                $media_url = 'assets/cultureQuiz/' . $imageName;
    
            } 

            $quiz->featured_image = $media_url ?? $quiz->featured_image;
            $quiz->title = $request->title;
            $quiz->description =  $request->description;

            $quiz->save();

            return redirect()->route('culture.quiz.index')->with('success', 'Quiz updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('culture.quiz.index')->with('error', 'An error occured while updating Quiz');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $city = CultureQuiz::findOrFail($id);
            $city->delete();
            return redirect()->route('culture.quiz.index')->with('success', 'Quiz deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('culture.quiz.index')->with('error', 'An error occurred while deleting Quiz');
        }
    }
}
