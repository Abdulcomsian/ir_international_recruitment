<?php

namespace App\Http\Controllers;

use App\Models\{
    History,
};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function history(){
        $history = History::with('history_images', 'title_description')->first();
        return view('histories.history', compact('history'));
    }
}
