<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class ServiceController extends Controller
{
    // ///////////APIS////////////////////////////////////
    public function getService()
    {
        try{
            $service =  Service::get();
            return response()->json([
                'status_code'=>200,
                'status' =>true,
                'message' => 'Services Found Successfully',
                'data' => $service,
            ]);
        }catch(\Exception $e){
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);
        }
       
    }

    ///////////API end HERE/////////////////////////

    /////////////ADMIN PANEL FUNCTIONS///////////////
    public function fetchService()
    {
        try{
            $service =  Service::get();
            return redirect('');
        }catch(\Exception $e){
            return response()->json(['status_code'=>500, 'status'=>false, 'error'=>$e->getMessage().'on line'.$e->getLine().'onFile'.$e->getFile()]);
        }
    }
    ////////////ADMIN PANEL FUNCTIONS END HERE///////
}
