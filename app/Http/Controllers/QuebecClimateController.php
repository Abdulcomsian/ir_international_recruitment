<?php

namespace App\Http\Controllers;

use App\Models\{QuebecClimate, QuebecClimateSeasonal};
use App\DataTables\QuebecClimateDataTable;
use App\Http\Requests\Quebec\Climate\{StoreRequest, UpdateRequest};
use App\Traits\RemoveFileTrait;

class QuebecClimateController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecClimateDataTable $dataTable)
    {
        return $dataTable->render('quebec.climate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quebec.climate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        try {

            //handle img
            if ($request->hasFile('img')) {

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecClimate');
                $image->move($imagePath, $imageName);
            }

            QuebecClimate::create([
                'img' => $imageName,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('quebec.climates.index')->with('success', 'Quebec Climate created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error', 'An error occured while creating Quebec Climate');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($quebecClimateId)
    {
        try {

            $quebecClimate = QuebecClimate::findOrFail($quebecClimateId);

            return view('quebec.climate.show', compact('quebecClimate'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error', 'Quebec Climate not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($quebecClimateId)
    {

        try {

            $quebecClimate = QuebecClimate::findOrFail($quebecClimateId);

            return view('quebec.climate.edit', compact('quebecClimate'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error', 'Quebec Climate not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $quebecClimateId)
    {

        try {

            $quebecClimate = QuebecClimate::findOrFail($quebecClimateId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecClimate/$quebecClimate->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecClimate');
                $image->move($imagePath, $imageName);

                $quebecClimate->img = $imageName;
            }

            $quebecClimate->title = $request->title;
            $quebecClimate->description = $request->description;

            $quebecClimate->save();

            return redirect()->route('quebec.climates.index')->with('success', 'Quebec Climate updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error', 'An error occured while updating Quebec Climate');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($quebecClimateId)
    {

        try {

            $quebecClimate = QuebecClimate::findOrFail($quebecClimateId);
            $this->unlinkFile("assets/QuebecClimate/$quebecClimate->img");
            $quebecClimate->delete();
            return redirect()->route('quebec.climates.index')->with('success', 'Quebec Climate deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error', 'An error occurred while deleting Quebec Climate');
        }

    }

    public function getAllMonths()
    {

        return [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

    }

    public function editSeasonal($quebecClimateId)
    {

        try {

            $quebecClimate = QuebecClimate::with('seasonal')->findOrFail($quebecClimateId);
            $months = $this->getAllMonths();

            return view('quebec.climate.seasonal.edit', compact('quebecClimate','months'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error', 'Quebec Climate not found');
        }

    }


    public function updateSeasonal(UpdateRequest $request, $quebecClimateId)
    {

        try {

            $quebecClimate = QuebecClimate::findOrFail($quebecClimateId);

            QuebecClimateSeasonal::updateOrCreate(
                ['quebec_climate_id' => $quebecClimate->id],
                [
                    'title' => $request->title,
                    'duration_from' => $request->duration_from,
                    'duration_to' => $request->duration_to,
                    'description' => $request->description,
                ]
            );

            return redirect()->route('quebec.climates.index')->with('success', 'Quebec Climate Seasonal updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.index')->with('error', 'An error occured while updating Quebec Climate Seasonal');
        }

    }


}
