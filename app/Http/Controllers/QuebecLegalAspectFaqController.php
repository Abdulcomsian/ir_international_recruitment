<?php

namespace App\Http\Controllers;

use App\Models\{QuebecLegalAspectFaq, QuebecLegalAspect};
use App\DataTables\QuebecLegalAspectFaqDataTable;
use App\Http\Requests\Quebec\LegalAspect\{FaqStoreRequest, FaqUpdateRequest};

class QuebecLegalAspectFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QuebecLegalAspectFaqDataTable $dataTable,$id)
    {

        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'faq')->findOrFail($id);
            return $dataTable->render('quebec.legal-aspects.faqs.index',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.index')->with('error','Quebec Legal Aspect Faq not found');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {

            $quebecLegalAspect = QuebecLegalAspect::where('type', 'faq')->findOrFail($id);
            return view('quebec.legal-aspects.faqs.create',compact('quebecLegalAspect'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('error','Quebec Legal Aspect Faq not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqStoreRequest $request, $id)
    {
        try {

            QuebecLegalAspectFaq::create([
                'quebec_legal_aspect_id' => $id,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('success', 'Faq created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('error', 'An error occured while creating Faq');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id,$quebecLegalAspectFaqId)
    {
        try {

            $quebecLegalAspectFaq = QuebecLegalAspectFaq::findOrFail($quebecLegalAspectFaqId);

            return view('quebec.legal-aspects.faqs.show', compact('quebecLegalAspectFaq'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('error', 'Faq not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$quebecLegalAspectFaqId)
    {

        try {

            $quebecLegalAspectFaq = QuebecLegalAspectFaq::with('quebecLegalAspect')->findOrFail($quebecLegalAspectFaqId);

            return view('quebec.legal-aspects.faqs.edit', compact('quebecLegalAspectFaq'));

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('error', 'Faq not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqUpdateRequest $request, $id, $quebecLegalAspectFaqId)
    {

        try {

            $quebecLegalAspectFaq = QuebecLegalAspectFaq::findOrFail($quebecLegalAspectFaqId);

            $quebecLegalAspectFaq->title = $request->title;
            $quebecLegalAspectFaq->description = $request->description;

            $quebecLegalAspectFaq->save();

            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('success', 'Faq updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('error', 'An error occured while updating Faq');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $quebecLegalAspectFaqId)
    {

        try {

            $quebecLegalAspectFaq = QuebecLegalAspectFaq::findOrFail($quebecLegalAspectFaqId);
            $quebecLegalAspectFaq->delete();
            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('success', 'Faq deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('quebec.legal-aspects.faqs.index',$id)->with('error', 'An error occurred while deleting Faq');
        }

    }
}
