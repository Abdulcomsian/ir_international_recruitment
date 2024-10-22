<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    UserController,
    HistoryController,
    ServiceController
};


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


// Verifying Email
Route::get('verify-email/{user_id}/{token}', [UserController::class, 'verifyEmail']);

Route::middleware(['auth:web', 'admin'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('history', [HomeController::class, 'history'])->name('view.history');
    Route::post('get-history-content', [HistoryController::class, 'getHistoryContent'])->name('get.history.content');
    Route::get('edit-history/{id}', [HistoryController::class, 'editHistory'])->name('edit.history');

    //////////Service ///////////////////////
    Route::get('fetch-service',[ServiceController::class,'fetchService']);
    Route::get('add-service',[ServiceController::class,'addService']);
    Route::get('edit-service/{id}',[ServiceController::class,'editService']);
    Route::get('update-service/{id}',[ServiceController::class,'updateService']);
    Route::get('delete-service/{id}',[ServiceController::class,'deleteService']);



    });