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
    TransportationController,
    SocialServiceLegalAidController,
    AgoraEventController,
    StayAnonymousController,
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
// Group routes related to "climates"
Route::prefix('support-and-advice')->group(function () {
    Route::post('/stay-anonymous/store', [StayAnonymousController::class, 'store']);
});

////////Service Routes////////////////
Route::middleware(['api_auth'])->group(function(){

    // Quebec
    Route::prefix('quebec')->group(function (){
        Route::get('get-services',[ServiceController::class,'getService']);

        // Cities
        Route::get('cities',CityController::class);
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
         ///Employee statistics///
        Route::prefix('employee')->group(function(){
            Route::get('/statistics',[EmployeeStatisticsController::class,'getStatistics']);
            Route::get('/currentTrends',[QuebecCurrentTrendController::class,'getCurrentTrends']);
            Route::get('/foreignDiploma',[ForeignDiplomaController::class,'foreignDiploma']);

        });

         // Tranportations
        Route::get('city-guide/transportations',[TransportationController::class, 'index']);
        // Social services
        Route::get('social-service/legal-aids',[SocialServiceLegalAidController::class, 'index']);

        // activities
        Route::get('activities/agora-events',[AgoraEventController::class, 'index']);

        //Quebec information culture///
        Route::get('history',[QuebecHistoryController::class,'quebecHistory']);
        Route::get('indeed/jobs',[IndeedJobController::class,'fetchJobs']);
    });



});
