<?php

namespace App\Http\Controllers;

use App\Models\{QuebecClimatePackingList, QuebecClimate};
use App\DataTables\QuebecClimatePackingListDataTable;
use App\Http\Requests\Quebec\Climate\{PackingListStoreRequest, PackingListUpdateRequest};
use App\Traits\RemoveFileTrait;

class QuebecClimatePackingListController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecClimatePackingListDataTable $dataTable,$id)
    {

        try {

            $quebecClimate = QuebecClimate::findOrFail($id);
            return $dataTable->forClimate($id)->render('quebec.climate.packing-list.index',compact('quebecClimate'));

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
            return view('quebec.climate.packing-list.create',compact('quebecClimate'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.packing-list.index',$id)->with('error','Quebec Climate not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackingListStoreRequest $request, $id)
    {
        try {

            //handle img
            if ($request->hasFile('img')) {

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecClimatePackingList');
                $image->move($imagePath, $imageName);
            }

            QuebecClimatePackingList::create([
                'quebec_climate_id' => $id,
                'img' => $imageName,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('quebec.climates.packing-list.index',$id)->with('success', 'Packing List created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.packing-list.index',$id)->with('error', 'An error occured while creating Packing List');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id,$quebecClimatePackingListId)
    {
        try {

            $quebecClimatePackingList = QuebecClimatePackingList::findOrFail($quebecClimatePackingListId);

            return view('quebec.climate.packing-list.show', compact('quebecClimatePackingList'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.packing-list.index',$id)->with('error', 'Packing List not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$quebecClimatePackingListId)
    {

        try {

            $quebecClimatePackingList = QuebecClimatePackingList::with('quebecClimate')->findOrFail($quebecClimatePackingListId);

            return view('quebec.climate.packing-list.edit', compact('quebecClimatePackingList'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.packing-list.index',$id)->with('error', 'Packing List not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackingListUpdateRequest $request, $id, $quebecClimatePackingListId)
    {

        try {

            $quebecClimatePackingList = QuebecClimatePackingList::findOrFail($quebecClimatePackingListId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecClimatePackingList/$quebecClimatePackingList->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecClimatePackingList');
                $image->move($imagePath, $imageName);

                $quebecClimatePackingList->img = $imageName;
            }

            $quebecClimatePackingList->title = $request->title;
            $quebecClimatePackingList->description = $request->description;

            $quebecClimatePackingList->save();

            return redirect()->route('quebec.climates.packing-list.index',$id)->with('success', 'Packing List updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.packing-list.index',$id)->with('error', 'An error occured while updating Packing List');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $quebecClimatePackingListId)
    {

        try {

            $quebecClimatePackingList = QuebecClimatePackingList::findOrFail($quebecClimatePackingListId);
            $this->unlinkFile("assets/QuebecClimatePackingList/$quebecClimatePackingList->img");
            $quebecClimatePackingList->delete();
            return redirect()->route('quebec.climates.packing-list.index',$id)->with('success', 'Packing List deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.climates.packing-list.index',$id)->with('error', 'An error occurred while deleting Packing List');
        }

    }
}
