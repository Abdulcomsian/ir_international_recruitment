<?php

namespace App\Http\Controllers;

use App\DataTables\EductionProgramDataTable;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\EductionProgram;
use App\Traits\RemoveFileTrait;

class EductionalProgramsController extends Controller
{
    use RemoveFileTrait;
    public function index(EductionProgramDataTable $datatable)
    {
        return $datatable->render('EductionalPrograms.index');
    }

    public function create()
    {
        $cities = City::all();
        return view('EductionalPrograms.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'university_type' => 'required|string',
            'city_id' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'title.required' => 'Name is required',
            'city_id.required' => 'City is required',
            'featured_image.images' => 'Image is required',
            'featured_image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif',
            'featured_image.max' => 'Image size should not exceed 2MB',
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
        $educationProgram->city_id = $request->city_id;
        $educationProgram->featured_image = $imageUrl ?? null;
        $educationProgram->save();

        return redirect()->route('eductional.programs.index')->with('success', 'University created successfully.');
    }

    public function show($id)
    {
        try {

            $program = EductionProgram::with('city')->find($id);
            return view('EductionalPrograms.show',compact('program'));

        } catch (\Exception $e) {
            return redirect()->route('eductional.programs.index')->with('error', 'University not found.');
        }
    }

    public function edit($id)
    {
        $program = EductionProgram::find($id);
        $cities = City::all();
        return view('EductionalPrograms.edit',compact('program','cities'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'university_type' => 'required|string',
            'city_id' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'title.required' => 'Name is required',
            'city_id.required' => 'City is required',
            'featured_image.images' => 'Image is required',
            'featured_image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif',
            'featured_image.max' => 'Image size should not exceed 2MB',
        ]);

        $educationProgram = EductionProgram::findOrFail($id);
        $educationProgram->title = $request->title;
        $educationProgram->university_type = $request->university_type;
        $educationProgram->city_id = $request->city_id;
        // Handle image upload if a new image is provided
        if ($request->hasFile('featured_image')) {
            // remove Old img
            $this->unlinkFile($educationProgram->featured_image);
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
            // remove img
            $this->unlinkFile($program->featured_image);
            $program->delete();
            return redirect()->route('eductional.programs.index')->with('success', 'University deleted successfully.');
        }

        return redirect()->route('eductional.programs.index')->with('success', 'University not found.');

    }
}
