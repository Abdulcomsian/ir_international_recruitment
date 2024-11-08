<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    QuebecHistoryController,
    ServiceController,
    UserController,
    IndeedJobController,
    EmployeeStatisticsController,
    QuebecCurrentTrendController,
    ForeignDiplomaController,

};
use App\Http\Controllers\Api\{
    QuebecFoodController,
    QuebecClimateController,
    QuebecLegalAspectController
};
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/verify-otp', [UserController::class, 'verifyOtp']);
// Route::post('/send-email-forgot-password', [UserController::class, 'sendEmailPassword']);
// Route::post('/verfiy-code', [UserController::class, 'verifyCode']);
// Route::post('/update-password', [UserController::class, 'updatePassword']);

////////Service Routes////////////////
Route::middleware(['auth:api'])->group(function(){
    Route::get('get-services',[ServiceController::class,'getService']);

    // Quebec
    Route::prefix('quebec')->group(function (){

        Route::get('/foods', [QuebecFoodController::class, 'index']);
        Route::get('/climates', [QuebecClimateController::class, 'index']);
        Route::get('/climates/seasonal/{id}', [QuebecClimateController::class, 'seasonal']);
        Route::get('/climates/packing-list/{id}', [QuebecClimateController::class, 'packingList']);
        Route::get('/climates/recommended-activities/{id}', [QuebecClimateController::class, 'recommendedActivities']);
        Route::get('/legal-aspects', [QuebecLegalAspectController::class, 'index']);

    });
    //Quebec information culture///
    Route::get('quebec/history',[QuebecHistoryController::class,'quebecHistory']);
    Route::get('indeed/jobs',[IndeedJobController::class,'fetchJobs']);

    ///Employee statistics///
    Route::prefix('employee')->group(function(){
        Route::get('/statistics',[EmployeeStatisticsController::class,'getStatistics']);
        Route::get('/currentTrends',[QuebecCurrentTrendController::class,'getCurrentTrends']);
        Route::get('/foreignDiploma',[ForeignDiplomaController::class,'foreignDiploma']);

    });
});
