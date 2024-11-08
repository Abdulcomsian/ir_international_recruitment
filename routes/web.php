<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    UserController,
    HistoryController,
    ServiceController,
    QuebecHistoryController,
    HistoricalEventsController,
    QuebecCurrentTrendController,
    EmployeeStatisticsController,
    JobSearchAdviceController,
    ForeignDiplomaController,
    ValidationGuideController,
    DiplomaResourceController,
    EductionalProgramsController,
    EducationProgramsDetailsController,
    QuebecFoodController,
    QuebecClimateController,
    QuebecClimatePackingListController,
    QuebecClimateRecommendedActivitiesController,
    QuebecLegalAspectController
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
    Route::get('fetch-services',[ServiceController::class,'fetchService'])->name('fetch-services');
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('add-service',[ServiceController::class,'addService'])->name('services.store');
    Route::get('edit-service/{id}',[ServiceController::class,'editService'])->name('services.edit');
    Route::put('update-service/{id}',[ServiceController::class,'updateService'])->name('services.update');
    Route::DELETE('delete-service/{id}',[ServiceController::class,'deleteService'])->name('services.destroy');
    // Route::resource('services', ServiceController::class);

    ///////////////Quebec Information////////////////////////////////////
                ////Quebec History//////
    Route::get('quebec/history/index',[QuebecHistoryController::class,'index'])->name('quebec.history.index');
    Route::get('quebec/history/create',[QuebecHistoryController::class,'create'])->name('quebec.history.create');
    Route::post('quebec/history/store',[QuebecHistoryController::class,'store'])->name('quebec.history.store');
    Route::get('quebec/history/edit/{id}',[QuebecHistoryController::class,'edit'])->name('quebec.history.edit');
    Route::put('quebec/history/update/{id}',[QuebecHistoryController::class,'update'])->name('quebec.history.update');
    Route::DELETE('quebec/history/delete/{id}',[QuebecHistoryController::class,'delete'])->name('quebec.history.delete');

    // qubec foods
    Route::resource('quebec/foods',QuebecFoodController::class,['as' => 'quebec']);
    // qubec climates
    Route::resource('quebec/climates',QuebecClimateController::class,['as' => 'quebec']);
    Route::get('quebec/climates/seasonal/{id}',[QuebecClimateController::class, 'editSeasonal'])->name('quebec.climates.seasonal');
    Route::put('quebec/climates/seasonal/update/{id}',[QuebecClimateController::class, 'updateSeasonal'])->name('quebec.climates.seasonal.update');
    Route::resource('quebec/climates/{id}/packing-list',QuebecClimatePackingListController::class,['as' => 'quebec.climates']);
    Route::resource('quebec/climates/{id}/recommended-activities',QuebecClimateRecommendedActivitiesController::class,['as' => 'quebec.climates']);
    // qubec legal aspects
    Route::resource('quebec/legal-aspects',QuebecLegalAspectController::class,['as' => 'quebec']);

                ////Quebec historical Events////
    Route::get('quebec/historical/events/index',[HistoricalEventsController::class,'index'])->name('quebec.historical.event.index');
    Route::get('quebec/historical/events/create',[HistoricalEventsController::class,'create'])->name('quebec.historical.event.create');
    Route::post('quebec/historical/events/store',[HistoricalEventsController::class,'store'])->name('quebec.historical.event.store');
    Route::get('quebec/historical/events/edit/{id}',[HistoricalEventsController::class,'edit'])->name('quebec.historical.event.edit');
    Route::put('quebec/historical/events/update/{id}',[HistoricalEventsController::class,'update'])->name('quebec.historical.event.update');
    Route::DELETE('quebec/historical/events/delete/{id}',[HistoricalEventsController::class,'delete'])->name('quebec.historical.event.delete');

    //////////////////////////Employment and Recogination////////////////
    //////////////Current Trned///////

    Route::prefix('quebec/current/trend')->group(function () {
        Route::get('/index', [QuebecCurrentTrendController::class, 'index'])->name('quebec.current.trend.index');
        Route::get('/create', [QuebecCurrentTrendController::class, 'create'])->name('quebec.current.trend.create');
        Route::post('/store', [QuebecCurrentTrendController::class, 'store'])->name('quebec.current.trend.store');
        Route::get('/edit/{id}', [QuebecCurrentTrendController::class, 'edit'])->name('quebec.current.trend.edit');
        Route::put('/update/{id}', [QuebecCurrentTrendController::class, 'update'])->name('quebec.current.trend.update');
        Route::delete('/delete/{id}', [QuebecCurrentTrendController::class, 'delete'])->name('quebec.current.trend.delete');
    });

    ///////EmployeeStatistics//////////////////////////
    Route::prefix('quebec/employee/statistics')->group(function() {
        Route::get('/index',[EmployeeStatisticsController::class,'index'])->name('quebec.employee.statistics.index');
        Route::get('/create',[EmployeeStatisticsController::class,'create'])->name('quebec.employee.statistics.create');
        Route::post('/store',[EmployeeStatisticsController::class,'store'])->name('quebec.employee.statistics.store');
        Route::get('/edit/{id}',[EmployeeStatisticsController::class,'edit'])->name('quebec.employee.statistics.edit');
        Route::put('/update/{id}',[EmployeeStatisticsController::class,'update'])->name('quebec.employee.statistics.update');
        Route::DELETE('/delete/{id}',[EmployeeStatisticsController::class,'delete'])->name('quebec.employee.statistics.delete');

    });

    //////////Job search Advice//////////////
    Route::prefix('job/search/advice')->group(function(){
        Route::get('/index',[JobSearchAdviceController::class,'index'])->name('job.search.advice.index');
        Route::get('/create',[JobSearchAdviceController::class,'create'])->name('job.search.advice.create');
        Route::post('/store',[JobSearchAdviceController::class,'store'])->name('job.search.advice.store');
        Route::get('/edit/{id}',[JobSearchAdviceController::class,'edit'])->name('job.search.advice.edit');
        Route::put('/update/{id}',[JobSearchAdviceController::class,'update'])->name('job.search.advice.update');
        Route::DELETE('/delete/{id}',[JobSearchAdviceController::class,'delete'])->name('job.search.advice.delete');


    });

    /////////////Validation for Foreign Diploma////////////////////
    Route::prefix('foreign/diploma/fields')->group(function(){
        Route::get('/index',[ForeignDiplomaController::class,'index'])->name('foreign.diploma.fields.index');
        Route::get('/create',[ForeignDiplomaController::class,'create'])->name('foreign.diploma.fields.create');
        Route::post('/store',[ForeignDiplomaController::class,'store'])->name('foreign.diploma.fields.store');
        Route::get('/edit/{id}',[ForeignDiplomaController::class,'edit'])->name('foreign.diploma.fields.edit');
        Route::put('/update/{id}',[ForeignDiplomaController::class,'update'])->name('foreign.diploma.fields.update');
        Route::DELETE('/delete/{id}',[ForeignDiplomaController::class,'delete'])->name('foreign.diploma.fields.delete');

    });

    //////////Validation Guide//////////////////////////////
    Route::prefix('diploma/validation')->group(function(){
        Route::get('/index',[ValidationGuideController::class,'index'])->name('diploma.validation.index');
        Route::get('/create',[ValidationGuideController::class,'create'])->name('diploma.validation.create');
        Route::post('/store',[ValidationGuideController::class,'store'])->name('diploma.validation.store');
        Route::get('/edit/{id}',[ValidationGuideController::class,'edit'])->name('diploma.validation.edit');
        Route::put('/update/{id}',[ValidationGuideController::class,'update'])->name('diploma.validation.update');
        Route::DELETE('/delete/{id}',[ValidationGuideController::class,'delete'])->name('diploma.validation.delete');

    });

    ////////////////Useful Resource /////////////////////////
    Route::prefix('diploma/resource')->group(function() {
        Route::get('/index',[DiplomaResourceController::class,'index'])->name('diploma.resource.index');
        Route::get('/create',[DiplomaResourceController::class,'create'])->name('diploma.resource.create');
        Route::post('/store',[DiplomaResourceController::class,'store'])->name('diploma.resource.store');
        Route::get('/edit/{id}',[DiplomaResourceController::class,'edit'])->name('diploma.resource.edit');
        Route::put('/update/{id}',[DiplomaResourceController::class,'update'])->name('diploma.resource.update');
        Route::DELETE('/delete/{id}',[DiplomaResourceController::class,'delete'])->name('diploma.resource.delete');
    });

    ////////Eductional Institutions and Programs////////////////////

    Route::prefix('eductional/programs')->group(function() {
        Route::get('/index',[EductionalProgramsController::class,'index'])->name('eductional.programs.index');
        Route::get('/create',[EductionalProgramsController::class,'create'])->name('eductional.programs.create');
        Route::post('/store',[EductionalProgramsController::class,'store'])->name('eductional.programs.store');
        Route::get('/edit/{id}',[EductionalProgramsController::class,'edit'])->name('eductional.programs.edit');
        Route::put('/update/{id}',[EductionalProgramsController::class,'update'])->name('eductional.programs.update');
        Route::DELETE('/delete/{id}',[EductionalProgramsController::class,'delete'])->name('eductional.programs.delete');
    });

    Route::prefix('eductional/programs/details')->group(function() {
        Route::get('/index',[EducationProgramsDetailsController::class,'index'])->name('eductional.programs.details.index');
        Route::get('/create',[EducationProgramsDetailsController::class,'create'])->name('eductional.programs.details.create');
        Route::post('/store',[EducationProgramsDetailsController::class,'store'])->name('eductional.programs.details.store');
        Route::get('/edit/{id}',[EducationProgramsDetailsController::class,'edit'])->name('eductional.programs.details.edit');
        Route::put('/update/{id}',[EducationProgramsDetailsController::class,'update'])->name('eductional.programs.details.update');
        Route::DELETE('/delete/{id}',[EducationProgramsDetailsController::class,'delete'])->name('eductional.programs.details.delete');
    });

    });
