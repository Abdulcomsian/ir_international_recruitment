<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    UserController,
};


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


// Verifying Email
Route::get('verify-email/{user_id}/{token}', [UserController::class, 'verifyEmail']);

Route::middleware(['auth:web', 'admin'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
});