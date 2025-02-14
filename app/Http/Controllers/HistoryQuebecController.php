<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\HistoryQuebec;
use App\Traits\RemoveFileTrait;
use App\DataTables\HistoryQuebecDataTable;

class HistoryQuebecController extends Controller
{
    use RemoveFileTrait;
    public function index(HistoryQuebecDataTable $dataTable)
    {
        return $dataTable->render('quebec.history.index');
    }

    public function create()
    {
        return view('quebec.history.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string',
            'featured_image'=>'nullable|image|mimes:jpg,jpeg,png,svg,gif',
            'sections' => 'required|array',
            'sections.*' => 'required|string',

        ]);
        $imageUrl = null;

        if($request->hasFile('featured_image'))
        {
            $image = $request->file('featured_image');
            $imageName= time(). '.' . $image->getClientOriginalExtension();
            $imagePath = public_path("assets/historyQuebecImages");

            $image->move($imagePath, $imageName);
            $imageUrl = "assets/historyQuebecImages/".$imageName;
        }

        $category = HistoryQuebec::create([
            'title' => $request->title,
            'featured_image' => $imageUrl,
        ]);

        // Check if category ID exists before inserting sections
        if (!$category || !$category->id) {
            return back()->with('error', 'Category creation failed.');
        }
        // Log::info('Category Created ID: ' . $category->id);


        foreach ($request->sections as $section) {
            Section::create([
                'history_quebec_id' => $category->id,
                'content' => $section,
            ]);
        }
     

        return redirect()->route('history-quebec.index')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = HistoryQuebec::find($id);
        return view('quebec.history.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif',
            'sections' => 'required|array',
            'sections.*' => 'required|string',
        ]);

        $category = HistoryQuebec::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($category->featured_image && file_exists(public_path($category->featured_image))) {
                unlink(public_path($category->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path("assets/historyQuebecImages");

            $image->move($imagePath, $imageName);
            $category->featured_image = "assets/historyQuebecImages/" . $imageName;
        }

        // Update category
        $category->title = $request->title;
        $category->save();

        // Remove existing sections and insert new ones
        $category->sections()->delete();

        foreach ($request->sections as $sectionContent) {
            Section::create([
                'history_quebec_id' => $category->id,
                'content' => $sectionContent,
            ]);
        }

        return redirect()->route('history-quebec.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = HistoryQuebec::find($id);
        $category->delete();
        return redirect()->route('history-quebec.index')->with('success', 'Category Deleted successfully!');

    }

}
