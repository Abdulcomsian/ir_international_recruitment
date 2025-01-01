<?php

namespace App\Http\Controllers;

use App\Models\{WithMyName};
use App\DataTables\WithMyNameDataTable;
use App\Traits\RemoveFileTrait;

class WithMyNameController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(WithMyNameDataTable $dataTable)
    {
        return $dataTable->render('support-and-advice.with-my-name.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($withMyNameId)
    {
        try {

            $withMyName = WithMyName::findOrFail($withMyNameId);

            return view('support-and-advice.with-my-name.show', compact('withMyName'));

        } catch (\Exception $e) {
            return redirect()->route('support-and-advice.with-my-name.index')->with('error', 'With My Name not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($withMyNameId)
    {

        try {

            $withMyName = WithMyName::findOrFail($withMyNameId);
            if($withMyName->img_proof){

                $this->unlinkFile("assets/WithMyName/$withMyName->img_proof");

            }

            if($withMyName->voice_msg){

                $this->unlinkFile("assets/WithMyName/$withMyName->voice_msg");

            }

            $withMyName->delete();
            return redirect()->route('support-and-advice.with-my-name.index')->with('success', 'With My Name deleted successfully');

        } catch (\Exception $e) {
            return redirect()->route('support-and-advice.with-my-name.index')->with('error', 'An error occurred while deleting With My Name');
        }

    }


}
