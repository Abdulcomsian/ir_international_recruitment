<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForeignDiploma;
use App\Models\UsefulResource;
use App\DataTables\UsefulResourceDataTable;

class DiplomaResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsefulResourceDataTable $dataTable)
    {
        return $dataTable->render('usefulResource.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diplomas = ForeignDiploma::get();

        return view('usefulResource.create',compact('diplomas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate Rules
        $rules = [
            'diploma_id' => 'nullable|integer',
            'visit_website' => 'nullable|string',
            'title' => 'nullable|string',
        ];

        $validate = $request->validate($rules,[]);
        try{

            $history = UsefulResource::create([
                'diploma_id' => $request->diploma_id,
                'visit_website' => $request->visit_website,
                'title' => $request->title,
            ]);
            return redirect()->route('diploma.resource.index')->with('success', 'Service created successfully.');
        }catch(\Exception $e){
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fields = ForeignDiploma::get();

        $resource = UsefulResource::find($id);
        return view('usefulResource.edit',compact('resource','fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation Rules
        $rules = [
            'diploma_id' => 'nullable|integer',
            'visit_website' => 'nullable|string',
            'title' => 'nullable|string',
        ];

        // Validate the request
        $validatedData = $request->validate($rules);

        try {
            // Find the existing resource by ID
            $resource = UsefulResource::find($id);

            if (!$resource) {
                return response()->json(['status_code' => 404, 'status' => false, 'error' => 'Resource not found.']);
            }

            // Update the existing resource with new data
            $resource->update([
                'diploma_id' => $request->diploma_id,
                'visit_website' => $request->visit_website,
                'title' => $request->title,
            ]);

            return redirect()->route('diploma.resource.index')->with('success', 'Resource updated successfully.');
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status' => false,
                'error' => $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $diploma = UsefulResource::find($id);
        
        if($diploma)
        {
            $diploma->delete();
            return redirect()->route('diploma.resource.index')->with('success', 'Validation Guide Deleted successfully.');
        }
        return redirect()->route('diploma.resource.index')->with('error', 'Validation Guide Not Found.');
    
    }
}
