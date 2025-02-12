<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\HistoryQuebecDataTable;
use App\Models\HistoryQuebec;
class HistoryQuebecController extends Controller
{
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
        $request->validate([
            'featured_image'=>'required|image|mimes:jpg,jpeg,png,svg,gif',
            'blog'=> 'required|string'
        ]);

        if($request->hasFile('featured_image'))
        {
            $image = $request->file('featured_image');
            $imageName= time(). '.' . $image->getClientOriginalExtension();
            $imagePath = public_path("assets/historyQuebecImages");

            $image->move($imagePath, $imageName);
        }

        HistoryQuebec::create([
            'blog' => $request->blog,
            'featured_image'=> $imageName,
        ]);


    }
}
