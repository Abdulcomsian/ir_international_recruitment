<?php

namespace App\Http\Controllers;

use App\Models\{StayAnonymous};
use App\DataTables\StayAnonymousDataTable;
use App\Traits\RemoveFileTrait;

class StayAnonymousController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(StayAnonymousDataTable $dataTable)
    {
        return $dataTable->render('support-and-advice.stay-anonymous.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($stayAnonymousId)
    {
        try {

            $stayAnonymous = StayAnonymous::findOrFail($stayAnonymousId);

            return view('support-and-advice.stay-anonymous.show', compact('stayAnonymous'));

        } catch (\Exception $e) {
            return redirect()->route('support-and-advice.stay-anonymous.index')->with('error', 'Stay Anonymous not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($stayAnonymousId)
    {

        try {

            $stayAnonymous = StayAnonymous::findOrFail($stayAnonymousId);
            if($stayAnonymous->img_proof){

                $this->unlinkFile("assets/StayAnonymous/$stayAnonymous->img_proof");

            }

            if($stayAnonymous->voice_msg){

                $this->unlinkFile("assets/StayAnonymous/$stayAnonymous->voice_msg");

            }

            $stayAnonymous->delete();
            return redirect()->route('support-and-advice.stay-anonymous.index')->with('success', 'Stay Anonymous deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('support-and-advice.stay-anonymous.index')->with('error', 'An error occurred while deleting Stay Anonymous');
        }

    }


}
