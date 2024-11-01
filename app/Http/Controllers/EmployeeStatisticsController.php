<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeStatisticsDataTable;
use App\Http\Resources\EmployeeStatisticsResource;
use Illuminate\Http\Request;
use App\Models\EmployeeStatistics;
use App\Traits\ApiResponseTrait;

class EmployeeStatisticsController extends Controller
{
    use ApiResponseTrait;

    public function getStatistics()
    {
        try{
            $statistics = EmployeeStatistics::get();
            $data = EmployeeStatisticsResource::collection($statistics);
            return $this->apiResponse($data, 'Employees fetched successfully');

        }catch(\Exception $e){
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);

        }
    }

    ///////////////////ADMIN PANEL/////////////////
    public function index(EmployeeStatisticsDataTable $dataTable)
    {
        return $dataTable->render('employeeStatistics.index');
    }

    public function create()
    {
        return view('employeeStatistics.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'label' => 'nullable|string|max:255',
            'media_url' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Adjust the max size as needed
        ]);

        // Handle the image upload
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/employee_statistics');
            $image->move($imagePath, $imageName);
            
            // Create the image URL
            $imageUrl = 'assets/employee_statistics/' . $imageName;

        }

        $state = new EmployeeStatistics();
        $state->title = $request->title;
        $state->state = $request->state;
        $state->label = $request->label;
        $state->media_url = $imageUrl ?? null; 
        $state->save();
        
        // Optionally redirect if not using JSON response
        return redirect()->route('quebec.employee.statistics.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $state = EmployeeStatistics::find($id);
        return view('employeeStatistics.edit',compact('state'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'label' => 'nullable|string|max:255',
            'media_url' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Adjust the max size as needed
        ]);

        $state = EmployeeStatistics::findOrFail($id);
        $state->title = $request->title;
        $state->state = $request->state;
        $state->label = $request->label;
        // Handle image upload if a new image is provided
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/employee_statistics');
            $image->move($imagePath, $imageName);

            $media_url = 'assets/employee_statistics/' . $imageName;

        }
        $state->media_url = $media_url ?? null; 

        $state->save();

        return redirect()->route('quebec.employee.statistics.index')->with('success', 'Employee Statistics updated successfully.');
    }

    public function delete($id)
    {
        $state= EmployeeStatistics::find($id);
        if($state)
        {
            if($state->media_url){
                $image= public_path($state->media_url);
                if(file_exists($image))
                {
                    unlink($image);
                }
            }
        }
        $state->delete();
        return redirect()->route('quebec.employee.statistics.index')->with('success', 'Service deleted successfully.');

    }
}
