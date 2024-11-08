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
        // foods
        Route::get('/foods', [QuebecFoodController::class, 'index']);
        // Group routes related to "climates"
        Route::prefix('climates')->group(function () {
            Route::get('/', [QuebecClimateController::class, 'index'])->name('index');
            Route::get('/seasonal/{id}', [QuebecClimateController::class, 'seasonal'])->name('seasonal');
            Route::get('/packing-list/{id}', [QuebecClimateController::class, 'packingList'])->name('packing-list');
            Route::get('/recommended-activities/{id}', [QuebecClimateController::class, 'recommendedActivities'])->name('recommended-activities');
        });
        // Group routes related to "legal-aspects"
        Route::prefix('legal-aspects')->group(function () {
            Route::get('/', [QuebecLegalAspectController::class, 'index'])->name('index');
            Route::get('/navigations', [QuebecLegalAspectController::class, 'navigations'])->name('navigations');
            Route::get('/faqs', [QuebecLegalAspectController::class, 'faqs'])->name('faqs');
        });
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
