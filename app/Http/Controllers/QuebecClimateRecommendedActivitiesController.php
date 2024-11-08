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
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error','Quebec Climate not found');
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
    public function show($id,$QuebecClimateRecommendedActivityId)
    {
        try {

            $QuebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::findOrFail($QuebecClimateRecommendedActivityId);

            return view('quebec.climate.recommended-activities.show', compact('QuebecClimateRecommendedActivity'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'Recommended Activity not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$QuebecClimateRecommendedActivityId)
    {

        try {

            $QuebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::with('quebecClimate')->findOrFail($QuebecClimateRecommendedActivityId);

            return view('quebec.climate.recommended-activities.edit', compact('QuebecClimateRecommendedActivity'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'Recommended Activity not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecommendedActivityUpdateRequest $request, $id, $QuebecClimateRecommendedActivityId)
    {

        try {

            $QuebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::findOrFail($QuebecClimateRecommendedActivityId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecClimateRecommendedActivity/$QuebecClimateRecommendedActivity->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecClimateRecommendedActivity');
                $image->move($imagePath, $imageName);

                $QuebecClimateRecommendedActivity->img = $imageName;
            }

            $QuebecClimateRecommendedActivity->title = $request->title;
            $QuebecClimateRecommendedActivity->type = $request->type;
            $QuebecClimateRecommendedActivity->description = $request->description;

            $QuebecClimateRecommendedActivity->save();

            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('success', 'Recommended Activity updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'An error occured while updating Recommended Activity');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $QuebecClimateRecommendedActivityId)
    {

        try {

            $QuebecClimateRecommendedActivity = QuebecClimateRecommendedActivity::findOrFail($QuebecClimateRecommendedActivityId);
            $this->unlinkFile("assets/QuebecClimateRecommendedActivity/$QuebecClimateRecommendedActivity->img");
            $QuebecClimateRecommendedActivity->delete();
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('success', 'Recommended Activity deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.recommended-activities.index',$id)->with('error', 'An error occurred while deleting Recommended Activity');
        }

    }
}
