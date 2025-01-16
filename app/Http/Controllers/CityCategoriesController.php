<?php

namespace App\Http\Controllers;

use App\DataTables\CityCategoryDataTable;
use Illuminate\Http\Request;
use Exception;
use App\Models\CityCategory;
use App\Http\Requests\Category\{StoreRequest, UpdateRequest};
use App\Traits\RemoveFileTrait;

class CityCategoriesController extends Controller
{
    use RemoveFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(CityCategoryDataTable $dataTable)
    {
        try{
            return $dataTable->render('categories.index');

        }catch(Exception $e){
            return redirect()->route('city.guide.categories.index')->with('error','City Categories not found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            return view('categories.create');

        } catch (\Exception $e) {
            return redirect()->route('city.guide.categories.index')->with('error','An error occurred while creating category');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

             // Handle the image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/cityCategories');
            $image->move($imagePath, $imageName);

            // Create the image URL
            $imageUrl = 'assets/cityCategories/' . $imageName;

            // $imageUrl = asset('assets/service_images/' . $imageName);
        }
            CityCategory::create([
                'title' => $request->title,
                'featured_image' => $imageUrl ?? Null,
                'url' => $request->url
            ]);

            return redirect()->route('city.guide.categories.index')->with('success', 'City Categories created successfully');
        } catch (\Exception $e) {
            return redirect()->route('city.guide.categories.index')->with('error', 'An error occured while creating City Category');
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
        try {

            $category = CityCategory::findOrFail($id);
            return view('categories.edit', compact('category'));

        } catch (\Exception $e) {
            return redirect()->route('city.guide.categories.index')->with('error', 'City Guide Categories not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $category = CityCategory::findOrFail($id);
        $category->title = $request->title;
        $category->url = $request->url;
        // Handle image upload if a new image is provided
        if ($request->hasFile('featured_image')) {
            // remove Old img
            $this->unlinkFile($category->featured_image);
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/eductionalPrograms');
            $image->move($imagePath, $imageName);

            $media_url = 'assets/eductionalPrograms/' . $imageName;

        }
        $category->featured_image = $media_url ?? $category->featured_image;

        $category->save();

        return redirect()->route('city.guide.categories.index')->with('success', 'City Categories Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
