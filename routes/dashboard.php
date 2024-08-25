<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'auth'],function(){
        Route::group(['prefix'=>'dashboards','as'=>'dashboard.'],function(){
            Route::get('/',[DashboardController::class,'index'])->name('index');
            Route::get('/user/update',[DashboardController::class,'user'])->name('user');
            Route::PUT('/user/edit', [DashboardController::class, 'update'])->name('update');

    });    
});
/************************ Dashboard Routes Ends ******************************/ 