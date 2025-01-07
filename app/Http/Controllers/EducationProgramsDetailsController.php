<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Subheading;
use Illuminate\Http\Request;
use App\Models\EductionProgram;
use App\Models\EducationProgramsDetails;
use App\DataTables\EducationProgramDetailsDataTable;

class EducationProgramsDetailsController extends Controller
{
    public function index(EducationProgramDetailsDataTable $dataTable)
    {
        return $dataTable->render('educationprogramdetails.index');
    }

    public function create()
    {
        $programs = EductionProgram::get();
        return view('educationprogramdetails.create',['programs'=>$programs]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'eduction_programs_id' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'financial_aid' => 'nullable|string',
            'campus' => 'nullable|string',
            // 'faculties' => 'nullable|string',
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string|max:255',
            'subheadings' => 'nullable|array',
            'subheadings.*' => 'nullable|array', // Ensure subheadings are arrays
            'subheadings.*.*' => 'nullable|string|max:255', // Add validation for subheading text

            'additional_program' => 'nullable|string',
            'research' => 'nullable|string',
            'student_life' => 'nullable|string',
        ]);

        
        // Create a new EductionProgram 
        $educationProgram = new EducationProgramsDetails();
        $educationProgram->eduction_programs_id = $request->eduction_programs_id;
        $educationProgram->address = $request->address;
        $educationProgram->about = $request->about;
        $educationProgram->financial_aid = $request->financial_aid;
        $educationProgram->campus = $request->campus;
        // $educationProgram->faculties = $request->faculties;
        $educationProgram->additional_program = $request->additional_program;
        $educationProgram->research = $request->research;
        $educationProgram->student_life = $request->student_life;

        $educationProgram->save();

        // Save Faculties and Subheadings
        foreach ($request->titles as $index => $title) {
            $faculty = Faculty::create([
                'education_program_id' => $educationProgram->id,
                'title' => $title,
            ]);
    
            if (isset($request->subheadings[$index]) && is_array($request->subheadings[$index])) {
                foreach ($request->subheadings[$index] as $subheading) {
                    if (!empty($subheading)) {

                        Subheading::create([
                            'faculty_id' => $faculty->id,
                            'subheading' => $subheading,
                        ]);
                    }
                }
            }
        }
        
        return redirect()->route('eductional.programs.details.index')->with('success', 'University Details added successfully.');
    }

    public function edit($id)
    {
        $program = EducationProgramsDetails::findOrFail($id);
        $programList = EductionProgram::get();
        $faculties = Faculty::with('subPrograms')->where('education_program_id',$id)->get();

        return view('educationprogramdetails.edit', compact('program', 'faculties','programList'));
    }


    public function view($id)
    {
        
        $program = EducationProgramsDetails::with(['getFaculty.subPrograms','educationProgram'])->findOrFail($id);
        return view('educationprogramdetails.view',compact('program'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate the incoming request
        $request->validate([
            'eduction_programs_id' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'financial_aid' => 'nullable|string',
            'campus' => 'nullable|string',
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string|max:255',
            'subheadings' => 'nullable|array',
            'subheadings.*' => 'nullable|array',
            'subheadings.*.*' => 'nullable|string|max:255',
            'additional_program' => 'nullable|string',
            'research' => 'nullable|string',
            'student_life' => 'nullable|string',
        ]);

        // Find the existing program details
        $programDetails = EducationProgramsDetails::findOrFail($id);
        $programDetails->eduction_programs_id = $request->eduction_programs_id;
        $programDetails->address = $request->address;
        $programDetails->about = $request->about;
        $programDetails->financial_aid = $request->financial_aid;
        $programDetails->campus = $request->campus;
        $programDetails->additional_program = $request->additional_program;
        $programDetails->research = $request->research;
        $programDetails->student_life = $request->student_life;
        $programDetails->save();

        $programDetails->getFaculty()->delete();  
        // Add new faculties and subheadings
        if ($request->has('titles')) {
            foreach ($request->titles as $index => $title) {
                // Create a new faculty
                $faculty = Faculty::create([
                    'education_program_id' => $programDetails->id,
                    'title' => $title
                ]);

                // Add subheadings for the faculty
                if (isset($request->subheadings[$index]) && is_array($request->subheadings[$index])) {
                    foreach ($request->subheadings[$index] as $subheading) {
                        if (!empty($subheading)) {
                            Subheading::create([
                                'faculty_id' => $faculty->id,
                                'subheading' => $subheading
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('eductional.programs.details.index')->with('success', 'University Details updated successfully.');
    }

    public function delete($id)
    {
        $program = EducationProgramsDetails::findOrFail($id);
        if($program)
        {
            $program->delete();
            return redirect()->route('eductional.programs.details.index')->with('success', 'University Details deleted successfully.');    
        }

        return redirect()->route('eductional.programs.details.index')->with('success', 'University not found.');    

    }

    public function update22222222(Request $request)
{
    // Get the Education Program by ID
    $educationProgram = EducationProgram::find($request->eduction_programs_id);

    // Update the main fields
    $educationProgram->update([
        'address' => $request->address,
        'about' => $request->about,
        'financial_aid' => $request->financial_aid,
        'campus' => $request->campus,
        'additional_program' => $request->additional_program,
        'research' => $request->research,
        'student_life' => $request->student_life,
    ]);

    // Handle titles and subheadings
    foreach ($request->titles as $index => $title) {
        // Update or create the faculty (title)
        $faculty = $educationProgram->faculties()->updateOrCreate(
            ['name' => $title],
            ['name' => $title]
        );

        // Ensure subheadings exist for the current title
        $subheadings = $request->subheadings[$index] ?? [];  // Default to an empty array if none exist

        // Create subheadings for the current title
        foreach ($subheadings as $subheading) {
            $faculty->subheadings()->updateOrCreate(['name' => $subheading]);
        }
    }

    return redirect()->route('educationPrograms.index');
}


}
