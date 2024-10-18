<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getHistoryContent(Request $request){
        // dd($request->all());
        try{
            $historyId = $request->history_id;
            $history = History::with('title_description')->where('id', $historyId)->first();
            if(!empty($history)){
                return response()->json(['success' => true, "data" => $history, "status", 200],200);
            }else{
                return response()->json(['success' => false, "msg" => "No data found", "status", 400],400);
            }
        }catch(\Exception $e){
            return response()->json(['success' => false, "msg" => "Something went wrong", "error" => $e->getMessage(), "line" => $e->getLine(), "status", 400],400);
        }
    }
}
