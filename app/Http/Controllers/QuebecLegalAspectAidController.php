<?php

namespace App\Http\Controllers;

use App\Models\{QuebecLegalAspectAid, QuebecLegalAspect, City};
use App\DataTables\QuebecLegalAspectAidDataTable;
use App\Http\Requests\Quebec\LegalAspect\{LegalAidStoreRequest, LegalAidUpdateRequest};
use App\Traits\RemoveFileTrait;

class QuebecLegalAspectAidController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecLegalAspectAidDataTable $dataTable,$id)
    {

        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'legal_aid')->findOrFail($id);
            return $dataTable->render('quebec.legal-aspects.legal-aids.index',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error','Quebec Legal Aspect Legal Aid not found');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'legal_aid')->findOrFail($id);
            $cities = City::all();
            return view('quebec.legal-aspects.legal-aids.create',compact('quebecLegalAspect','cities'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('error','Quebec Legal Aspect Legal Aid not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LegalAidStoreRequest $request, $id)
    {
        try {

            //handle img
            if ($request->hasFile('img')) {

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecLegalAspectAid');
                $image->move($imagePath, $imageName);
            }

            QuebecLegalAspectAid::create([
                'quebec_legal_aspect_id' => $id,
                'city_id' => $request->city_id,
                'img' => $imageName,
                'title' => $request->title,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('success', 'LegalAid created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('error', 'An error occured while creating LegalAid');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id,$quebecLegalAspectAidId)
    {
        try {

            $quebecLegalAspectAid = QuebecLegalAspectAid::with('city')->findOrFail($quebecLegalAspectAidId);

            return view('quebec.legal-aspects.legal-aids.show', compact('quebecLegalAspectAid'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('error', 'LegalAid not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$quebecLegalAspectAidId)
    {

        try {

            $quebecLegalAspectAid = QuebecLegalAspectAid::with('quebecLegalAspect')->findOrFail($quebecLegalAspectAidId);
            $cities = City::all();
            return view('quebec.legal-aspects.legal-aids.edit', compact('quebecLegalAspectAid','cities'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('error', 'LegalAid not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LegalAidUpdateRequest $request, $id, $quebecLegalAspectLegalAidId)
    {

        try {

            $quebecLegalAspectLegalAid = QuebecLegalAspectAid::findOrFail($quebecLegalAspectLegalAidId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecLegalAspectAid/$quebecLegalAspectLegalAid->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecLegalAspectAid');
                $image->move($imagePath, $imageName);

                $quebecLegalAspectLegalAid->img = $imageName;
            }

            $quebecLegalAspectLegalAid->city_id = $request->city_id;
            $quebecLegalAspectLegalAid->title = $request->title;
            $quebecLegalAspectLegalAid->email = $request->email;
            $quebecLegalAspectLegalAid->phone_no = $request->phone_no;
            $quebecLegalAspectLegalAid->address = $request->address;
            $quebecLegalAspectLegalAid->latitude = $request->latitude;
            $quebecLegalAspectLegalAid->longitude = $request->longitude;

            $quebecLegalAspectLegalAid->save();

            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('success', 'Legal Aid updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('error', 'An error occured while updating Legal Aid');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $quebecLegalAspectAidId)
    {

        try {

            $quebecLegalAspectAid = QuebecLegalAspectAid::findOrFail($quebecLegalAspectAidId);
            $this->unlinkFile("assets/QuebecLegalAspectAid/$quebecLegalAspectAid->img");
            $quebecLegalAspectAid->delete();
            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('success', 'Legal Aid deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.legal-aids.index',$id)->with('error', 'An error occurred while deleting Legal Aid');
        }

    }
}
