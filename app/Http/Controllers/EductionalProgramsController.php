<?php

namespace App\Http\Controllers;

use App\DataTables\EductionProgramDataTable;
use Illuminate\Http\Request;
use App\Models\EductionProgram;

class EductionalProgramsController extends Controller
{
    public function index(EductionProgramDataTable $datatable)
    {
        return $datatable->render('EductionalPrograms.index');
    }

    public function create()
    {
        return view('EductionalPrograms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'university_type' => 'nullable|string',
            'location' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/eductionalPrograms');
            $image->move($imagePath, $imageName);
            
            // Create the image URL
            $imageUrl = 'assets/eductionalPrograms/' . $imageName;

            // $imageUrl = asset('assets/service_images/' . $imageName);
        }

        // Create a new EductionProgram 
        $educationProgram = new EductionProgram();
        $educationProgram->title = $request->title;
        $educationProgram->university_type = $request->university_type;
        $educationProgram->location = $request->location;
        $educationProgram->featured_image = $imageUrl ?? null; 
        $educationProgram->save();
        
        return redirect()->route('eductional.programs.index')->with('success', 'University created successfully.');
    }

    public function edit($id)
    {
        $program = EductionProgram::find($id);
        return view('EductionalPrograms.edit',compact('program'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'nullable|string|max:255',
            'university_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Adjust the max size as needed
        ]);

        $educationProgram = EductionProgram::findOrFail($id);
        $educationProgram->title = $request->title;
        $educationProgram->university_type = $request->university_type;
        $educationProgram->location = $request->location;
        // Handle image upload if a new image is provided
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/eductionalPrograms');
            $image->move($imagePath, $imageName);

            $media_url = 'assets/eductionalPrograms/' . $imageName;

        }
        $educationProgram->featured_image = $media_url ?? $educationProgram->featured_image; 

        $educationProgram->save();

        return redirect()->route('eductional.programs.index')->with('success', 'University updated successfully.');
    }

    public function delete($id)
    {
        $program = EductionProgram::findOrFail($id);
        if($program)
        {
            $program->delete();
            return redirect()->route('eductional.programs.index')->with('success', 'University deleted successfully.');    
        }

        return redirect()->route('eductional.programs.index')->with('success', 'University not found.');    

    }
}
