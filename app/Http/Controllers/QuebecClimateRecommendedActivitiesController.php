<?php

namespace App\Http\Controllers;

use App\Models\{QuebecClimateRecommendedActivity, QuebecClimate};
use App\DataTables\QuebecClimateRecommendedActivitiesDataTable;
use App\Http\Requests\Quebec\Climate\{RecommendedActivityStoreRequest, RecommendedActivityUpdateRequest};
use App\Traits\RemoveFileTrait;

class QuebecClimateRecommendedActivitiesController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecClimateRecommendedActivitiesDataTable $dataTable,$id)
    {
        try {

            $quebecClimate = QuebecClimate::findOrFail($id);
            return $dataTable->render('quebec.climate.recommended-activities.index',compact('quebecClimate'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error','Quebec Climate not found');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {

            $quebecClimate = QuebecClimate::findOrFail($id);
            return view('quebec.climate.recommended-activities.create',compact('quebecClimate'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error','Quebec Climate not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecommendedActivityStoreRequest $request, $id)
    {
        try {

            //handle img
            if ($request->hasFile('img')) {

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecClimateRecommendedActivity');
                $image->move($imagePath, $imageName);
            }

            QuebecClimateRecommendedActivity::create([
                'quebec_climate_id' => $id,
                'img' => $imageName,
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description
            ]);

            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('success', 'Recommended Activity created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'An error occured while creating Recommended Activity');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id,$quebecClimateRecommendedActivityId)
    {
        try {

            $quebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::findOrFail($quebecClimateRecommendedActivityId);

            return view('quebec.climate.recommended-activities.show', compact('quebecClimateRecommendedActivity'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'Recommended Activity not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$quebecClimateRecommendedActivityId)
    {

        try {

            $quebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::with('quebecClimate')->findOrFail($quebecClimateRecommendedActivityId);

            return view('quebec.climate.recommended-activities.edit', compact('quebecClimateRecommendedActivity'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'Recommended Activity not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecommendedActivityUpdateRequest $request, $id, $quebecClimateRecommendedActivityId)
    {

        try {

            $quebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::findOrFail($quebecClimateRecommendedActivityId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecClimateRecommendedActivity/$quebecClimateRecommendedActivity->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecClimateRecommendedActivity');
                $image->move($imagePath, $imageName);

                $quebecClimateRecommendedActivity->img = $imageName;
            }

            $quebecClimateRecommendedActivity->title = $request->title;
            $quebecClimateRecommendedActivity->type = $request->type;
            $quebecClimateRecommendedActivity->description = $request->description;

            $quebecClimateRecommendedActivity->save();

            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('success', 'Recommended Activity updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'An error occured while updating Recommended Activity');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $quebecClimateRecommendedActivityId)
    {

        try {

            $quebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::findOrFail($quebecClimateRecommendedActivityId);
            $this->unlinkFile("assets/QuebecClimateRecommendedActivity/$quebecClimateRecommendedActivity->img");
            $quebecClimateRecommendedActivity->delete();
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('success', 'Recommended Activity deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'An error occurred while deleting Recommended Activity');
        }

    }
}
