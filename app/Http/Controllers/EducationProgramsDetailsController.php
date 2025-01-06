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
        // dd($request->subheadings);
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
        $program = EducationProgramsDetails::find($id);
        $programList = EductionProgram::get();
        return view('educationprogramdetails.edit',compact('program','programList'));
    }

    public function view($id)
    {
        
        $program = EducationProgramsDetails::with(['getFaculty.subheadings','educationProgram'])->findOrFail($id);
        
        // dd($program->toArray());
        // $university= $program->educationProgram->title;

        // $subheadingTitles = $program->faculties->flatMap(function ($faculty) {
        //     return $faculty->subheadings->pluck('title');
        // });
        // dd($subheadingTitles); // Debug subheading titles to verify

        // dd($program->faculties->subheadings);
        return view('educationprogramdetails.view',compact('program'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'eduction_programs_id' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'financial_aid' => 'nullable|string',
            'campus' => 'nullable|string',
            'faculties' => 'nullable|string',
            'additional_program' => 'nullable|string',
            'research' => 'nullable|string',
            'student_life' => 'nullable|string',
        ]);

        $programDetails = EducationProgramsDetails::findOrFail($id);
        $programDetails->eduction_programs_id = $request->eduction_programs_id;
        $programDetails->address = $request->address;
        $programDetails->about = $request->about;
        $programDetails->financial_aid = $request->financial_aid;
        $programDetails->campus = $request->campus;
        $programDetails->faculties = $request->faculties;
        $programDetails->additional_program = $request->additional_program;
        $programDetails->research = $request->research;
        $programDetails->student_life = $request->student_life;
       
        $programDetails->save();

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
}
