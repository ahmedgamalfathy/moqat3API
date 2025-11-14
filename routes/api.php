<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Dashboard\Media\MediaController;
use App\Http\Controllers\API\V1\Dashboard\Slider\SliderController;

  Route::prefix('v1/admin')->group(function () {
        Route::apiResources([
                "sliders"=> SliderController::class,
                "media"=> MediaController::class,
        ]);
        Route::prefix('selects')->group(function(){
        // Route::get('', [SelectController::class, 'getSelects']);
        });

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
