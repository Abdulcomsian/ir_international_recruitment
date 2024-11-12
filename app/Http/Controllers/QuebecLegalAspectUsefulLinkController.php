<?php

namespace App\Http\Controllers;

use App\Models\{QuebecLegalAspectUsefulLink, QuebecLegalAspect};
use App\DataTables\QuebecLegalAspectUsefulLinkDataTable;
use App\Http\Requests\Quebec\LegalAspect\{UsefulLinkStoreRequest, UsefulLinkUpdateRequest};

class QuebecLegalAspectUsefulLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecLegalAspectUsefulLinkDataTable $dataTable,$id)
    {

        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'useful_links')->findOrFail($id);
            return $dataTable->render('quebec.legal-aspects.useful-links.index',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error','Quebec Legal Aspect Useful Link not found');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'useful_links')->findOrFail($id);
            return view('quebec.legal-aspects.useful-links.create',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('error','Quebec Legal Aspect Useful Link not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsefulLinkStoreRequest $request, $id)
    {
        try {

            QuebecLegalAspectUsefulLink::create([
                'quebec_legal_aspect_id' => $id,
                'title' => $request->title,
                'link' => $request->link
            ]);

            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('success', 'Useful link created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('error', 'An error occured while creating Useful link');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $quebecLegalAspectUsefulLinkId)
    {
        try {

            $quebecLegalAspectUsefulLink = QuebecLegalAspectUsefulLink::findOrFail($quebecLegalAspectUsefulLinkId);

            return view('quebec.legal-aspects.useful-links.show', compact('quebecLegalAspectUsefulLink'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('error', 'Useful Link not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $quebecLegalAspectUsefulLinkId)
    {

        try {

            $quebecLegalAspectUsefulLink = QuebecLegalAspectUsefulLink::with('quebecLegalAspect')->findOrFail($quebecLegalAspectUsefulLinkId);

            return view('quebec.legal-aspects.useful-links.edit', compact('quebecLegalAspectUsefulLink'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('error', 'Useful Link not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsefulLinkUpdateRequest $request, $id, $quebecLegalAspectUsefulLinkId)
    {

        try {

            $quebecLegalAspectUsefulLink = QuebecLegalAspectUsefulLink::findOrFail($quebecLegalAspectUsefulLinkId);

            $quebecLegalAspectUsefulLink->title = $request->title;
            $quebecLegalAspectUsefulLink->link = $request->link;

            $quebecLegalAspectUsefulLink->save();

            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('success', 'Useful Link updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('error', 'An error occured while updating Useful Link');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $quebecLegalAspectUsefulLinkId)
    {

        try {

            $quebecLegalAspectUsefulLink = QuebecLegalAspectUsefulLink::findOrFail($quebecLegalAspectUsefulLinkId);
            $quebecLegalAspectUsefulLink->delete();
            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('success', 'Useful Link deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.useful-links.index',$id)->with('error', 'An error occurred while deleting Useful Link');
        }

    }
}
