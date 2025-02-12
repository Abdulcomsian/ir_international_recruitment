<?php

namespace App\Http\Controllers;

use App\DataTables\ToDoListDataTable;
use Illuminate\Http\Request;
use App\Models\ToDoList;
use App\Traits\RemoveFileTrait;

class ToDoListController extends Controller
{
    use RemoveFileTrait;
    public function index(ToDoListDataTable $dataTable)
    {
        return $dataTable->render('home.todoList.index');
    }

    public function create()
    {
        return view('home.todoList.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'featured_image'=>'image|mimes:jpg,jpeg,png,svg,gif',
            'blog'=>'required|string',
            'status'=> 'required|in:pending,completed'
        ]);

        if($request->hasFile('featured_image'))
        {
            $image = $request->file('featured_image');
            $imageName = time(). '.'.$image->getClientOriginalExtension();
            $imagePath = public_path('assets/toDolistimages');

            $image->move($imagePath, $imageName); 

            $imageUrl = "assets/toDolistimages/".$imageName;
        }

        ToDoList::create([
            'featured_image' => $imageUrl,
            'blog' => $request->blog,
            'status' => $request->status,
        ]);

        return redirect()->route('toDoList.index');


    }

    public function edit($id)
    {
       $list = ToDoList::find($id);
        return view('home.todoList.edit',compact('list'));
    }

    public function update1(Request $request, $id)
    {
        $list = ToDoList::find($id);
        // dd($list);

        if($request->hasFile('featured_image'))
        {
            $this->unlinkFile($list->featured_image);

            $image = $request->file('featured_image');
            $imageName = time(). '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('assets/toDolistimages');

            $image->move($imagePath,$imageName);

            $imageUrl = "assets/toDolistimages/".$imageName;
        }

        $list->blog = $request->blog;
        $list->featured_image = $imageUrl;
        $list->status = $request->status;
        $list->save();

        return redirect()->route('toDoList.index');

    }

    public function update(Request $request, $id)
    {
        $list = ToDoList::findOrFail($id); // Better to use findOrFail for error handling
        $request->validate([
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'         => 'required|in:pending,completed',
            'blog'           => 'required|string',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($list->featured_image && file_exists(public_path($list->featured_image))) {
                unlink(public_path($list->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/toDolistimages';

            $image->move(public_path($imagePath), $imageName);

            $list->featured_image = $imagePath . '/' . $imageName;
        }

        $list->status = $request->status;
        $list->blog = $request->blog;
        $list->save();

        return redirect()->route('toDoList.index')->with('success', 'To-Do List updated successfully!');
    }

    public function show($id)
    {
        $list = ToDoList::findOrFail($id);
        return view('home.todoList.show',compact('list'));

    }

    public function destroy($id)
    {
        $list = ToDoList::findOrFail($id);

        if ($list->featured_image && file_exists(public_path($list->featured_image))) {
            unlink(public_path($list->featured_image)); 
        }

        $list->delete();
        return redirect()->route('toDoList.index')->with('success', 'To-Do List updated successfully!');

    }

}
