<?php

namespace App\Http\Controllers;

use App\DataTables\ForeignDiplomaDataTable;
use App\Http\Resources\ForeignDiplomaResource;
use Illuminate\Http\Request;
use App\Models\ForeignDiploma;
use App\Traits\ApiResponseTrait;
use App\Traits\RemoveFileTrait;

class ForeignDiplomaController extends Controller
{
    use ApiResponseTrait, RemoveFileTrait;
    ////////////API//////////////////
    public function foreignDiploma()
    {
        try{
            $diploma = ForeignDiploma::with('ValidationGuide.diploma','resources.diploma')->get();
            $data = ForeignDiplomaResource::collection($diploma);

            return $this->apiResponse($data,'Foreign Diploma Data Fetched');
        }catch(\Exception $e)
        {
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);

        }
    }
    /////////////Admin Panel/////////
    public function index(ForeignDiplomaDataTable $dataTable)
    {
        return $dataTable->render('foreignDiploma.index');
    }

    public function create()
    {
        return view('foreignDiploma.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'media_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('media_url')) {
            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/foreignDiploma_images');
            $image->move($imagePath, $imageName);

            // Create the image URL
            $imageUrl = 'assets/foreignDiploma_images/' . $imageName;

            // $imageUrl = asset('assets/service_images/' . $imageName);
        }

        // Create a new jobserach
        $diploma = new ForeignDiploma();
        $diploma->title = $request->title;
        $diploma->media_url = $imageUrl ?? null;
        $diploma->save();

        return redirect()->route('foreign.diploma.fields.index')->with('success', 'Foreign Diploma Fields Created created Successfully.');

    }

    public function edit($id)
    {
        $diploma = ForeignDiploma::find($id);
        return view('foreignDiploma.edit',compact('diploma'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'media_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $diploma = ForeignDiploma::findOrFail($id);
        $diploma->title = $request->title;

        // Handle image upload if a new image is provided
        if ($request->hasFile('media_url')) {
            // Delete the old image if necessary
            // Storage::delete(public_path('assets/services/' . basename($service->image_url))); // Optional cleanup
            // remove Old img
            $this->unlinkFile($diploma->media_url);

            $image = $request->file('media_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/foreignDiploma_images');
            $image->move($imagePath, $imageName);

            $diploma->media_url = 'assets/foreignDiploma_images/' . $imageName;

        }

        $diploma->save();

        return redirect()->route('foreign.diploma.fields.index')->with('success', 'Foreign Diploma updated successfully.');
    }

    public function delete($id)
    {
        $diploma = ForeignDiploma::find($id);

        if ($diploma) {
            if ($diploma->media_url) {
                $imagePath = public_path($diploma->media_url);

                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }
            }
              $diploma->delete();

            return redirect()->route('foreign.diploma.fields.index')->with('success', 'foreign diploma deleted successfully.');
        }

        return redirect()->route('foreign.diploma.fields.index')->with('error', 'foreign diploma not found.');
    }
}
