<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuebecHistoryCategory;
use App\Models\HistoryQuebec;
class QuebecCategoryHistoryController extends Controller
{
    public function getQuebecHistoryCategories()
    {
        try{
            $categories = QuebecHistoryCategory::get();
            return response()->json([
                'status_code'=>200,
                'msg' => 'history category fetched successfully',
                'data' => $categories
            ]);
        }catch(\Exception $e){

            return response()->json([
                'status_code'=>200,
                'msg' => 'An Issue Occured'.$e->getMessage(),
            ]);
        }
    }

    
    public function getQuebecHistoryDetails($id)
    {
        
    }
}
