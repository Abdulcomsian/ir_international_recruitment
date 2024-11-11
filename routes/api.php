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
    CityController,
    QuebecFoodController,
    QuebecClimateController,
    QuebecLegalAspectController,
    TransportationController
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

    // Cities
    Route::get('cities',CityController::class);
    // Quebec
    Route::prefix('quebec')->group(function (){
        // foods
        Route::get('/foods', [QuebecFoodController::class, 'index']);
        // Group routes related to "climates"
        Route::prefix('climates')->group(function () {
            Route::get('/', [QuebecClimateController::class, 'index']);
            Route::get('/seasonal/{id}', [QuebecClimateController::class, 'seasonal']);
            Route::get('/packing-list/{id}', [QuebecClimateController::class, 'packingList']);
            Route::get('/recommended-activities/{id}', [QuebecClimateController::class, 'recommendedActivities']);
        });
        // Group routes related to "legal-aspects"
        Route::prefix('legal-aspects')->group(function () {
            Route::get('/', [QuebecLegalAspectController::class, 'index']);
            Route::get('/navigations', [QuebecLegalAspectController::class, 'navigations']);
            Route::get('/faqs', [QuebecLegalAspectController::class, 'faqs']);
            Route::get('/useful-links', [QuebecLegalAspectController::class, 'usefulLinks']);
            Route::get('/legal-aids', [QuebecLegalAspectController::class, 'legalAids']);
        });
    });
    // Tranportations
    Route::get('city-guide/transportations',[TransportationController::class, 'index']);

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
