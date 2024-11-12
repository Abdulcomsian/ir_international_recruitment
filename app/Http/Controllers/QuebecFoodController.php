<?php

namespace App\Http\Controllers;

use App\Models\QuebecFood;
use App\DataTables\QuebecFoodDataTable;
use App\Http\Requests\Quebec\Food\{StoreRequest, UpdateRequest};
use App\Traits\RemoveFileTrait;

class QuebecFoodController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecFoodDataTable $dataTable)
    {
        return $dataTable->render('quebec.food.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quebec.food.create');
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
                $imagePath = public_path('assets/QuebecFood');
                $image->move($imagePath, $imageName);
            }

            QuebecFood::create([
                'img' => $imageName,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('quebec.foods.index')->with('success', 'Quebec Food created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.foods.index')->with('error', 'An error occured while creating Quebec Food');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($quebecFoodId)
    {
        try {

            $quebecFood = QuebecFood::findOrFail($quebecFoodId);

            return view('quebec.food.show', compact('quebecFood'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.foods.index')->with('error', 'Quebec Food not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($quebecFoodId)
    {

        try {

            $quebecFood = QuebecFood::findOrFail($quebecFoodId);

            return view('quebec.food.edit', compact('quebecFood'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.foods.index')->with('error', 'Quebec Food not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $quebecFoodId)
    {

        try {

            $quebecFood = QuebecFood::findOrFail($quebecFoodId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecFood/$quebecFood->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecFood');
                $image->move($imagePath, $imageName);

                $quebecFood->img = $imageName;
            }

            $quebecFood->title = $request->title;
            $quebecFood->description = $request->description;

            $quebecFood->save();

            return redirect()->route('quebec.foods.index')->with('success', 'Quebec Food updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.foods.index')->with('error', 'An error occured while updating Quebec Food');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($quebecFoodId)
    {

        try {

            $quebecFood = QuebecFood::findOrFail($quebecFoodId);
            $this->unlinkFile("assets/QuebecFood/$quebecFood->img");
            $quebecFood->delete();
            return redirect()->route('quebec.foods.index')->with('success', 'Quebec Food deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.foods.index')->with('error', 'An error occurred while deleting Quebec Food');
        }

    }
}
