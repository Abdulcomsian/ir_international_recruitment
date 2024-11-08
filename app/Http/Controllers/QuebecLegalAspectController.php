<?php

namespace App\Http\Controllers;

use App\Models\{QuebecLegalAspect};
use App\DataTables\QuebecLegalAspectDataTable;
use App\Http\Requests\Quebec\LegalAspect\{StoreRequest, UpdateRequest};
use App\Traits\RemoveFileTrait;

class QuebecLegalAspectController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecLegalAspectDataTable $dataTable)
    {
        return $dataTable->render('quebec.legal-aspects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quebec.legal-aspects.create');
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
                $imagePath = public_path('assets/QuebecLegalAspect');
                $image->move($imagePath, $imageName);
            }

            QuebecLegalAspect::create([
                'img' => $imageName,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('quebec.legal-aspects.index')->with('success', 'Quebec Legal Aspect created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error', 'An error occured while creating Quebec Legal Aspect');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($quebecLegalAspectId)
    {
        try {

            $quebecLegalAspect = QuebecLegalAspect::findOrFail($quebecLegalAspectId);

            return view('quebec.legal-aspects.show', compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error', 'Quebec Legal Aspect not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($quebecLegalAspectId)
    {

        try {

            $quebecLegalAspect = QuebecLegalAspect::findOrFail($quebecLegalAspectId);

            return view('quebec.legal-aspects.edit', compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error', 'Quebec Legal Aspect not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $quebecLegalAspectId)
    {

        try {

            $quebecLegalAspect = QuebecLegalAspect::findOrFail($quebecLegalAspectId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecLegalAspect/$quebecLegalAspect->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecLegalAspect');
                $image->move($imagePath, $imageName);

                $quebecLegalAspect->img = $imageName;
            }

            $quebecLegalAspect->title = $request->title;
            $quebecLegalAspect->description = $request->description;

            $quebecLegalAspect->save();

            return redirect()->route('quebec.legal-aspects.index')->with('success', 'Quebec Legal Aspect updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error', 'An error occured while updating Quebec Legal Aspect');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($quebecLegalAspectId)
    {

        try {

            $quebecLegalAspect = QuebecLegalAspect::findOrFail($quebecLegalAspectId);
            $this->unlinkFile("assets/QuebecLegalAspect/$quebecLegalAspect->img");
            $quebecLegalAspect->delete();
            return redirect()->route('quebec.legal-aspects.index')->with('success', 'Quebec Legal Aspect deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error', 'An error occurred while deleting Quebec Legal Aspect');
        }

    }

}
