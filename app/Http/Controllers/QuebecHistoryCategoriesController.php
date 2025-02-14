<?php

namespace App\Http\Controllers;

use App\DataTables\QuebecHistoryCategoryDataTable;
use Illuminate\Http\Request;
use App\Models\QuebecHistoryCategory;
use App\Traits\RemoveFileTrait;

class QuebecHistoryCategoriesController extends Controller
{
    use RemoveFileTrait;
    public function index(QuebecHistoryCategoryDataTable $dataTable)
    {
        return $dataTable->render('quebec.category.index');
    }

    public function create()
    {
        return view('quebec.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'featured_image'=> 'required|mimes:jpg,jpeg,svg,png,gif',
            'title' => 'required|string'
        ]);

        if($request->hasFile('featured_image'))
        {
            $image=$request->file('featured_image');
            $imageName = time(). '.' . $image->getClientOriginalExtension();
            $imagePath =public_path("assets/historyCategory");

            $image->move($imagePath, $imageName);

            $imageUrl = "assets/historyCategory/".$imageName;
        }

        $category = QuebecHistoryCategory::create([
            'title' => $request->title,
            'featured_image' => $imageUrl,
        ]);

        return redirect()->route('quebec-history-categories.index');

    }

    public function edit($id)
    {
        $category = QuebecHistoryCategory::find($id);
        return view('quebec.category.edit',compact('category'));

    }

    public function update(Request $request, $id)
    {
        $category = QuebecHistoryCategory::find($id);
        if(!$category)
        {
            return redirect()->route('quebec-history-categories.index');

        }
        $imageUrl = $category->featured_image;

        if($request->hasFile('featured_image'))
        {
            if (!empty($category->featured_image) && file_exists(public_path($category->featured_image))) {
                unlink(public_path($category->featured_image));
            }            $image = $request->file('featured_image');
            $imageName = time(). '.' . $image->getClientOriginalExtension();
            $imagePath =public_path("assets/historyCategory");

            $image->move($imagePath,$imageName);

            $imageUrl = "assets/historyCategory/".$imageName;

        }

        $category->update(
            [
                'title' => $request->title,
                'featured_image'=> $imageUrl,
            ]
            );

        return redirect()->route('quebec-history-categories.index');

    }

    public function destroy($id)
    {
        // dd($id);
        $category = QuebecHistoryCategory::find($id);
        if(!$category)
        {
            return redirect()->route('quebec-history-categories.index');
        }
        $category->delete();
        return redirect()->route('quebec-history-categories.index');

    }
}
