<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ToDoList;
use Exception;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    
    public function getToDoList(){
        try{
            $list = ToDoList::get();
            return response()->json([
                'status'=> true,
                'msg' => 'To do list Fetched Successfully',
                'data' => $list
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status'=> true,
                'msg' =>"An issue occured". $e->getMessage(),
            ]);
        }
    }

    public function CompletedToDoList()
    {
        try{
            $list = ToDoList::where('status','completed')->get();
            return response()->json([
                'status'=> true,
                'msg' => 'To do list Fetched Successfully',
                'data' => $list
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status'=> true,
                'msg' =>"An issue occured". $e->getMessage(),
            ]);
        }
    }
}
