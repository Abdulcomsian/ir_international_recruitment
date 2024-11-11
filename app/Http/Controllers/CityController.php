<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\DataTables\CityDataTable;
use App\Http\Requests\City\{StoreRequest, UpdateRequest};

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CityDataTable $dataTable)
    {

        try {

            return $dataTable->render('cities.index');

        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error','City not found');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            return view('cities.create');

        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error','An error occurred while creating city');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            City::create([
                'name' => $request->name
            ]);

            return redirect()->route('cities.index')->with('success', 'City created successfully');
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'An error occured while creating City');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($cityId)
    {
       abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cityId)
    {

        try {

            $city = City::findOrFail($cityId);
            return view('cities.edit', compact('city'));

        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'City not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $cityId)
    {

        try {

            $city = City::findOrFail($cityId);

            $city->name = $request->name;

            $city->save();

            return redirect()->route('cities.index')->with('success', 'City updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'An error occured while updating City');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cityId)
    {

        try {

            $city = City::findOrFail($cityId);
            $city->delete();
            return redirect()->route('cities.index')->with('success', 'City deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'An error occurred while deleting City');
        }

    }
}
