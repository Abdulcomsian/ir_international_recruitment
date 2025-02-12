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
    WithMyNameController,
    UniversityController,
    CultureQuizController,
    CityGuideServicesController,
    CityVideoController,
    ToDoListController,
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
Route::middleware(['api_auth'])->group(function(){

    // Quebec
    Route::prefix('quebec')->group(function (){
        //HOME todolist
        Route::get('getToDoList',[ToDoListController::class,'getToDoList']);
        Route::get('getCompletedToDoList',[ToDoListController::class,'CompletedToDoList']);


        Route::get('get-services',[ServiceController::class,'getService']);

        // Cities
        Route::get('cities',CityController::class);

        //city videos
        Route::get('get-city-videos/{id}',[CityVideoController::class,'getCityVideos']);
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
            Route::get('/quiz', [QuebecLegalAspectController::class, 'quiz']);
            Route::get('/questions/{id}', [QuebecLegalAspectController::class, 'questions']);
            Route::post('/submit/answer/{id}',[QuebecLegalAspectController::class,'submitAnswer']);
            Route::post('/store/result/{id}',[QuebecLegalAspectController::class,'storeResult']);

        });
         ///Employee statistics///
        Route::prefix('employee')->group(function(){
            Route::get('/statistics',[EmployeeStatisticsController::class,'getStatistics']);
            Route::get('/currentTrends',[QuebecCurrentTrendController::class,'getCurrentTrends']);
            Route::get('/foreignDiploma',[ForeignDiplomaController::class,'foreignDiploma']);

        });

         // Tranportations
        Route::post('city-guide/transportations',[TransportationController::class, 'index']);

        //city guide services
        Route::get('city-guide/services',[CityGuideServicesController::class, 'getServices']);

        // Social services
        Route::get('social-service/legal-aids',[SocialServiceLegalAidController::class, 'index']);

        // activities
        Route::get('activities/agora-events',[AgoraEventController::class, 'index']);

        // Group routes support and advice
        Route::prefix('support-and-advice')->group(function () {
            Route::post('/stay-anonymous/store', [StayAnonymousController::class, 'store']);
            Route::post('/with-my-name/store', [WithMyNameController::class, 'store']);
        });

        //Quebec information culture///
        Route::get('history',[QuebecHistoryController::class,'quebecHistory']);
        Route::get('indeed/jobs',[IndeedJobController::class,'fetchJobs']);

        Route::prefix('university')->group(function() {
            Route::get('',[UniversityController::class,'getAllUniversities']);
            Route::get('details/{id}',[UniversityController::class,'getUniversitiesDetails']);
        });

        Route::prefix('culture/quiz')->group(function() {
            Route::get('',[CultureQuizController::class,'getCultureList']);
            Route::get('/details/{id}',[CultureQuizController::class,'getQuizDetails']);
            Route::get('/questions/{id}',[CultureQuizController::class,'getQuestions']);
            Route::post('/submit/answer/{id}',[CultureQuizController::class,'submitAnswer']);
            Route::post('/store/result/{id}',[CultureQuizController::class,'storeResult']);

        });

    });



});
