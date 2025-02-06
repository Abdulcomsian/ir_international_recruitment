<?php

namespace App\Http\Controllers;

use App\DataTables\CityServiceDataTable;
use Illuminate\Http\Request;
use App\Models\CityService;
use App\Http\Requests\CityService\{StoreRequest,UpdateRequest};

class CityServicesController extends Controller
{
    public function index(CityServiceDataTable $dataTable)
    {
        try {

            return $dataTable->render('city-guide.services.index');

        } catch (\Exception $e) {
            return redirect()->route('city-guide.services.index')->with('error','An error occured while showing services');
        }   
    }

    public function create()
    {
        try{
            return view('city-guide.services.create');
        }catch(\Exception $e){
            return redirect()->route('city-guide.services.index')->with('error','An error occurred while creating service');
        }
    }

    public function store(StoreRequest $request)
    {
         
        $service = CityService::create([
            'title' => $request->title,
            'category'=> $request->category,
        ]);
        
        return redirect()->route('city-guide.services.index')->with('success', 'City Services created successfully.');
    }

    public function edit($id)
    {
        $service =  CityService::find($id);
        return view('city-guide.services.edit',compact('service'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $service = CityService::findOrFail($id);
       
        $service->update([
            'title' => $request->title,
            'category'=> $request->category,
        ]);

        return redirect()->route('city-guide.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = CityService::find($id);

        if ($service) {
            
              $service->delete();

            return redirect()->route('city-guide.services.index')->with('success', 'Service deleted successfully.');
        }

        return redirect()->route('city-guide.services.index')->with('error', 'trend not found.');
    }
}
