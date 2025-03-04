<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\HistoryQuebec;
use App\Traits\RemoveFileTrait;
use App\Models\QuebecHistoryCategory;
use App\DataTables\HistoryQuebecDataTable;

class HistoryQuebecController extends Controller
{
    use RemoveFileTrait;
    public function index(HistoryQuebecDataTable $dataTable, QuebecHistoryCategory $quebecHistoryCategory)
    {
        try{
            $id = $quebecHistoryCategory->id;
            // dd($id);
            $dataTable->Id = $id;
            return $dataTable->render('quebec.history.index',compact('id'));

        }catch(\Exception $e){

        }
        
    }

    public function create($id)
    {
        try{
            return view('quebec.history.create',compact('id'));

        }catch(\Exception $e)
        {
            return redirect()->route('quebec-history-categories.history-quebec.index', $id)
            ->with('success', 'Quebec History created successfully!');
        }
    }

    public function store(Request $request, QuebecHistoryCategory $quebecHistoryCategory)
    {
        try{
            $request->validate([
                'title' => 'required|string|max:255',
                'featured_image' => 'required|image|mimes:jpg,jpeg,png',
                'sections' => 'array',  // Validate sections if necessary
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
    
            // Create the history entry and associate it with the category
            $category = HistoryQuebec::create([
                'title' => $request->input('title'),
                'featured_image' => $imageUrl,
                'category_id' => $quebecHistoryCategory->id, // Assign the category ID here
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            if (!$category || !$category->id) {
                return back()->with('error', 'Category creation failed.');
            }
    
            foreach ($request->sections as $section) {
                Section::create([
                    'history_quebec_id' => $category->id,
                    'content' => $section,
                ]);
            }
    
            return redirect()->route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id)
                            ->with('success', 'Quebec History created successfully!');

        }catch(\Exception $e){
            return redirect()->route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id)
            ->with('success', 'Quebec History created successfully!');
        }
        
    }

    public function show(QuebecHistoryCategory $quebecHistoryCategory, HistoryQuebec $historyQuebec)
    {
        try{
            return view('quebec.history.show',compact('historyQuebec','quebecHistoryCategory'));
        }catch(\Exception $exception)
        {
            return redirect()->route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id)
            ->with('success', 'Quebec History created successfully!');
        }
    }

    public function edit(QuebecHistoryCategory $quebecHistoryCategory, HistoryQuebec $historyQuebec)
    {
        try{
            $historyQuebecId= $historyQuebec->id;
            $quebecHistoryCategoryId = $quebecHistoryCategory->id;
            return view('quebec.history.edit',compact('historyQuebec','quebecHistoryCategory'));
    
        }catch(\Exception $e){
            return redirect()->route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id)
            ->with('success', 'Quebec History created successfully!');
        }
       
    }

    public function update(Request $request,  QuebecHistoryCategory $quebecHistoryCategory, HistoryQuebec $historyQuebec)
    {
        try{
            if ($historyQuebec->category_id !== $quebecHistoryCategory->id) {
                abort(404, 'This quebec history does not belong to the specified category.');
            }
            $validated = $request->validate([
                'title' => 'required|string',
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif',
                'sections' => 'required|array',
                'sections.*' => 'required|string',
            ]);
    
            // Handle image upload
            if ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($historyQuebec->featured_image && file_exists(public_path($historyQuebec->featured_image))) {
                    unlink(public_path($historyQuebec->featured_image));
                }
    
                $image = $request->file('featured_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path("assets/historyQuebecImages");
    
                $image->move($imagePath, $imageName);
                $historyQuebec->featured_image = "assets/historyQuebecImages/" . $imageName;
            }
    
            // Update category
            $historyQuebec->title = $validated['title'];
            $historyQuebec->save();
    
            // Remove existing sections and insert new ones
            $historyQuebec->sections()->delete();
    
            foreach ($request->sections as $sectionContent) {
                Section::create([
                    'history_quebec_id' => $historyQuebec->id,
                    'content' => $sectionContent,
                ]);
            }
    
            return redirect()->route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id)
                            ->with('success', 'Quebec History created successfully!');

        }catch(\Exception $e){
            return redirect()->route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id)
            ->with('success', 'Quebec History created successfully!');
        }
        
    }

   
    public function destroy(QuebecHistoryCategory $quebecHistoryCategory, HistoryQuebec $historyQuebec)
    {
        try{
            $quebec = $historyQuebec->delete();
            return redirect()->route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id)
            ->with('success', 'Quebec History Deleted Successfully!');
        }catch(\Exception $e){
            return response()->json([
                'msg'=> $e->getMessage()
            ]);
        }
        
    }


}
