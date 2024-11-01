<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForeignDiploma;
use App\Models\ValidationGuide;
use App\DataTables\ValidationGuideDataTable;

class ValidationGuideController extends Controller
{
    public function index(ValidationGuideDataTable $dataTable)
    {
        return $dataTable->render('validationGuide.index');
    }

    public function create()
    {
        $diplomas = ForeignDiploma::get();
        return view('validationGuide.create', compact('diplomas'));
    }

    public function store(Request $request)
    {
        //Validate Rules
        $rules = [
            'diploma_id' => 'nullable|integer',
            'validation_organization' => 'nullable|string',
            'visit_website' => 'nullable|string',
            'validation_guides' => 'nullable|string',
        ];

        $validate = $request->validate($rules,[]);
        try{

            $history = ValidationGuide::create([
                'diploma_id' => $request->diploma_id,
                'validation_organization' => $request->validation_organization,
                'visit_website' => $request->visit_website,
                'validation_guides' => $request->validation_guides,
                'validation_organization' => $request->validation_organization,
            ]);
            return redirect()->route('diploma.validation.index')->with('success', 'Service created successfully.');
        }catch(\Exception $e){
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);

        }
    }

    public function edit($id)
    {
        $fields = ForeignDiploma::get();

        $diploma = ValidationGuide::find($id);
        return view('validationGuide.edit',compact('diploma','fields'));
    }

    public function delete($id)
    {
        $diploma = ValidationGuide::find($id);
        if($diploma)
        {
            $diploma->delete();
            return redirect()->route('diploma.validation.index')->with('success', 'Validation Guide Deleted successfully.');
        }
        return redirect()->route('diploma.validation.index')->with('error', 'Validation Guide Not Found.');
    }
}
