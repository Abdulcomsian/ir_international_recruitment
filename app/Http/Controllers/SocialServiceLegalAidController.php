<?php

namespace App\Http\Controllers;

use App\Models\{SocialServiceLegalAid, City};
use App\DataTables\SocialServiceLegalAidDataTable;
use App\Http\Requests\SocialService\{StoreRequest, UpdateRequest};
use App\Traits\RemoveFileTrait;

class SocialServiceLegalAidController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SocialServiceLegalAidDataTable $dataTable)
    {

        try {

            return $dataTable->render('social-services.index');

        } catch (\Exception $e) {
            return redirect()->route('social-services.index')->with('error','Social Service not found');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $cities = City::all();
            return view('social-services.create',compact('cities'));

        } catch (\Exception $e) {
            return redirect()->route('social-services.index')->with('error','Social Service not found');
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
                $imagePath = public_path('assets/SocialServiceLegalAid');
                $image->move($imagePath, $imageName);
            }

            SocialServiceLegalAid::create([
                'city_id' => $request->city_id,
                'img' => $imageName,
                'title' => $request->title,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'address' => $request->address
            ]);

            return redirect()->route('social-services.index')->with('success', 'Social Service Legal Aid created successfully');
        } catch (\Exception $e) {
            return redirect()->route('social-services.index')->with('error', 'An error occured while creating Social Service Legal Aid');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($socialServiceLegalAidId)
    {
        try {

            $socialServiceLegalAid = SocialServiceLegalAid::with('city')->findOrFail($socialServiceLegalAidId);

            return view('social-services.show', compact('socialServiceLegalAid'));

        } catch (\Exception $e) {
            return redirect()->route('social-services.index')->with('error', 'Social Service Legal Aid not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($socialServiceLegalAidId)
    {

        try {

            $socialServiceLegalAid = SocialServiceLegalAid::findOrFail($socialServiceLegalAidId);
            $cities = City::all();
            return view('social-services.edit', compact('socialServiceLegalAid','cities'));

        } catch (\Exception $e) {
            return redirect()->route('social-services.index')->with('error', 'Social Service Legal Aid not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $socialServiceLegalAidId)
    {

        try {

            $socialServiceLegalAid = SocialServiceLegalAid::findOrFail($socialServiceLegalAidId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/SocialServiceLegalAid/$socialServiceLegalAid->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/SocialServiceLegalAid');
                $image->move($imagePath, $imageName);

                $socialServiceLegalAid->img = $imageName;
            }

            $socialServiceLegalAid->city_id = $request->city_id;
            $socialServiceLegalAid->title = $request->title;
            $socialServiceLegalAid->email = $request->email;
            $socialServiceLegalAid->phone_no = $request->phone_no;
            $socialServiceLegalAid->address = $request->address;

            $socialServiceLegalAid->save();

            return redirect()->route('social-services.index')->with('success', 'Social Service Legal Aid updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('social-services.index')->with('error', 'An error occured while updating Social Service Legal Aid');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($socialServiceLegalAidId)
    {

        try {

            $socialServiceLegalAid = SocialServiceLegalAid::findOrFail($socialServiceLegalAidId);
            $this->unlinkFile("assets/SocialServiceLegalAid/$socialServiceLegalAid->img");
            $socialServiceLegalAid->delete();
            return redirect()->route('social-services.index')->with('success', 'Social Service Legal Aid deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('social-services.index')->with('error', 'An error occurred while deleting Social Service Legal Aid');
        }

    }
}
