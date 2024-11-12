<?php

namespace App\Http\Controllers;

use App\DataTables\FinancialAidDataTable;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\FinancialAid;

class FinancialAidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FinancialAidDataTable $dataTable)
    {
        return $dataTable->render('financialAid.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::get();
        return view('financialAid.create',['programs'=>$programs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'title' => 'required|string',
            'featured_image' => 'required|image',
            'link' =>'required|string'
        ]);

        try{
            if($request->hasFile('featured_image'))
            {
                $image= $request->file('featured_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = public_path('assets/financialAid_images');
    
                $image->move($imagePath, $imageName);
    
                $imageUrl = "assets/financialAid_images/". $imageName;
            }
    
            $financialAid = new FinancialAid;
            $financialAid->title = $request->title;
            $financialAid->program_id = $request->program_id;
            $financialAid->link = $request->link;
            $financialAid->featured_image = $imageUrl;
            $financialAid->save();

            // dd($financialAid);

    
            return redirect()->route('financial.aid.programs.index')->with('success', 'Financial Aid Created created Successfully.');
    
        }catch(\Exception $e){
            return redirect()->route('financial.aid.programs.index')->with('error', 'Problem occur while Creating Financial Aid.');

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
        $aid = FinancialAid::find($id);
        $programs = Program::get();

        return view('financialAid.edit',['aid'=>$aid, 'programs'=>$programs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'program_id' => 'nullable|exists:programs,id',
            'title' => 'nullable|string',
            'featured_image' => 'nullable|image',
            'link' =>'nullable|string'
        ]);

        try{
            $financial_aid = FinancialAid::findOrFail($id);
            $financial_aid->program_id = $request->program_id;
            $financial_aid->title = $request->title;
            $financial_aid->link = $request->link;
            // Handle image upload if a new image is provided
            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/financialAid_images/');
                $image->move($imagePath, $imageName);

                $media_url = 'assets/financialAid_images/' . $imageName;

            }
            $financial_aid->featured_image = $media_url ?? null; 

            $financial_aid->save();

            return redirect()->route('financial.aid.programs.index')->with('success', 'Employee Aid updated successfully.');
        
        }catch(\Exception $e){
            return redirect()->route('financial.aid.programs.index')->with('error', 'error occur while Employee Aid updated.');

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $financialAid =  FinancialAid::find($id);
            if($financialAid)
            {
                $financialAid->delete();
                return redirect()->route('financial.aid.programs.index')->with('success', 'Financial Aid Deleted Successfully.');
            }
            return redirect()->route('financial.aid.programs.index')->with('error', 'Financial Aid not  exist.');
    
        }catch(\Exception $e)
        {
            return redirect()->route('financial.aid.programs.index')->with('error', 'Issue occur while Deleting Financial Aid.');

        }
      
    }
}
