<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// protected routes

Route::middleware('auth:sanctum')->group(function (){
    
        Route::get('events', [ApiController::class, 'getEvent']); 
        Route::get('now-showing', [ApiController::class, 'getNowShowing']);
        Route::get('event-images', [ApiController::class,'getEventImages']);

        //Thubmnail
        Route::get('event-image', [ApiController::class,'getEventImag']);

        //Event Image
        Route::get('event-images/{id}', [ApiController::class,'getEventImage']);

        //Other Shows
        Route::get('event/{id}', [ApiController::class,'getEventName']);

        Route::get('contact', [ApiController::class, 'getContact']);

        Route::get('slider', [ApiController::class, 'getSliders']);

        Route::get('logo', [ApiController::class, 'getLogo']);

});

Route::post('post-community', [CommunityController::class, 'postCommnity']); 


