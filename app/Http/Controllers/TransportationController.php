<?php

namespace App\Http\Controllers;

use App\Models\{Transportation, City};
use App\DataTables\TransportationDataTable;
use App\Http\Requests\CityGuide\Transportation\{StoreRequest, UpdateRequest};
use App\Traits\RemoveFileTrait;

class TransportationController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(TransportationDataTable $dataTable)
    {

        try {

            return $dataTable->render('city-guide.transportations.index');

        } catch (\Exception $e) {
            return redirect()->route('city-guide.transportations.index')->with('error','An error occured while showing Transportations');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $cities = City::all();
            return view('city-guide.transportations.create',compact('cities'));

        } catch (\Exception $e) {
            return redirect()->route('city-guide.transportations.index')->with('error','An error occured while creating Transportation');
        }
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
                $imagePath = public_path('assets/Transportation');
                $image->move($imagePath, $imageName);
            }

            Transportation::create([
                'city_id' => $request->city_id,
                'img' => $imageName,
                'title' => $request->title,
                'type' => $request->type,
                'contact_no' => $request->contact_no,
                'location' => $request->location,
                'description' => $request->description,
                'from_price' => $request->from_price,
                'to_price' => $request->to_price,
                'website_url' => $request->website_url,
            ]);

            return redirect()->route('city-guide.transportations.index')->with('success', 'Transportation created successfully');
        } catch (\Exception $e) {

            dd($e->getMessage());
            return redirect()->route('city-guide.transportations.index')->with('error', 'An error occured while creating Transportation');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($transportationId)
    {
        try {

            $transportation = Transportation::with('city')->findOrFail($transportationId);

            return view('city-guide.transportations.show', compact('transportation'));

        } catch (\Exception $e) {
            return redirect()->route('city-guide.transportations.index')->with('error', 'Transportation not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($transportationId)
    {

        try {

            $transportation = Transportation::with('city')->findOrFail($transportationId);
            $cities = City::all();
            return view('city-guide.transportations.edit', compact('transportation','cities'));

        } catch (\Exception $e) {
            return redirect()->route('city-guide.transportations.index')->with('error', 'Transportation not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $transportationId)
    {

        try {

            $transportation = Transportation::findOrFail($transportationId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/Transportation/$transportation->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/Transportation');
                $image->move($imagePath, $imageName);

                $transportation->img = $imageName;
            }

            $transportation->city_id = $request->city_id;
            $transportation->title = $request->title;
            $transportation->type = $request->type;
            $transportation->contact_no = $request->contact_no;
            $transportation->location = $request->location;
            $transportation->description = $request->description;
            $transportation->from_price = $request->from_price;
            $transportation->to_price = $request->to_price;
            $transportation->website_url = $request->website_url;

            $transportation->save();

            return redirect()->route('city-guide.transportations.index')->with('success', 'Transportation updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('city-guide.transportations.index')->with('error', 'An error occured while updating Transportation');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($transportationId)
    {

        try {

            $transportation = Transportation::findOrFail($transportationId);
            $this->unlinkFile("assets/Transportation/$transportation->img");
            $transportation->delete();
            return redirect()->route('city-guide.transportations.index')->with('success', 'Transportation deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('city-guide.transportations.index')->with('error', 'An error occurred while deleting Transportation');
        }

    }
}
