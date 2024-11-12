<?php

namespace App\Http\Controllers;

use App\DataTables\ProgramDataTable;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index(ProgramDataTable $datatable)
    {
        return $datatable->render('programs.index');
    }

    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'nullable|string|max:255',
        ]);

        // Create a new program
        $service = new Program();
        $service->title = $request->title;
        $service->save();
        
        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }


    public function edit($id)
    {
        $program =  Program::find($id);
        return view('programs.edit',compact('program'));
    }

    public function update (Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
        ]);
        $service = Program::findOrFail($id);
        $service->title = $request->title;

        $service->save();

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    public function delete($id)
    {
        $program = Program::find($id);
    
        // Check if the service exists
        if ($program) {
            // Delete the service record 
            $program->delete();
    
            return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
        }
    
        return redirect()->route('programs.index')->with('error', 'program not found.');
    }
}
