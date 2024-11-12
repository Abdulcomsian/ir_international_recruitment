<?php

namespace App\Http\Controllers;

use App\Models\{QuebecLegalAspectNavigation, QuebecLegalAspect};
use App\DataTables\QuebecLegalAspectNavigationDataTable;
use App\Http\Requests\Quebec\LegalAspect\{NavigationStoreRequest, NavigationUpdateRequest};
use App\Traits\RemoveFileTrait;

class QuebecLegalAspectNavigationController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecLegalAspectNavigationDataTable $dataTable,$id)
    {

        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'key_navigation')->findOrFail($id);
            return $dataTable->render('quebec.legal-aspects.navigations.index',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error','Quebec Legal Aspect Navigation not found');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'key_navigation')->findOrFail($id);
            return view('quebec.legal-aspects.navigations.create',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('error','Quebec Legal Aspect Navigation not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NavigationStoreRequest $request, $id)
    {
        try {

            //handle img
            if ($request->hasFile('img')) {

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecLegalAspectNavigation');
                $image->move($imagePath, $imageName);
            }

            QuebecLegalAspectNavigation::create([
                'quebec_legal_aspect_id' => $id,
                'img' => $imageName,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('success', 'Navigation created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('error', 'An error occured while creating Navigation');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id,$quebecLegalAspectNavigationId)
    {
        try {

            $quebecLegalAspectNavigation = QuebecLegalAspectNavigation::findOrFail($quebecLegalAspectNavigationId);

            return view('quebec.legal-aspects.navigations.show', compact('quebecLegalAspectNavigation'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('error', 'Navigation not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$quebecLegalAspectNavigationId)
    {

        try {

            $quebecLegalAspectNavigation = QuebecLegalAspectNavigation::with('quebecLegalAspect')->findOrFail($quebecLegalAspectNavigationId);

            return view('quebec.legal-aspects.navigations.edit', compact('quebecLegalAspectNavigation'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('error', 'Navigation not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NavigationUpdateRequest $request, $id, $quebecLegalAspectNavigationId)
    {

        try {

            $quebecLegalAspectNavigation = QuebecLegalAspectNavigation::findOrFail($quebecLegalAspectNavigationId);

            //handle img
            if ($request->hasFile('img')) {

                // remove Old img
                $this->unlinkFile("assets/QuebecLegalAspectNavigation/$quebecLegalAspectNavigation->img");

                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/QuebecLegalAspectNavigation');
                $image->move($imagePath, $imageName);

                $quebecLegalAspectNavigation->img = $imageName;
            }

            $quebecLegalAspectNavigation->title = $request->title;
            $quebecLegalAspectNavigation->description = $request->description;

            $quebecLegalAspectNavigation->save();

            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('success', 'Navigation updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('error', 'An error occured while updating Navigation');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $quebecLegalAspectNavigationId)
    {

        try {

            $quebecLegalAspectNavigation = QuebecLegalAspectNavigation::findOrFail($quebecLegalAspectNavigationId);
            $this->unlinkFile("assets/QuebecLegalAspectNavigation/$quebecLegalAspectNavigation->img");
            $quebecLegalAspectNavigation->delete();
            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('success', 'Navigation deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.navigations.index',$id)->with('error', 'An error occurred while deleting Navigation');
        }

    }
}
