<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    
};


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
});