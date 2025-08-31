<?php

use App\Http\Controllers\constructionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\UserAuthController;
use App\Http\Controllers\auth\AdminAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group([ 'prefix' => 'auth'], function ($router) {

    Route::post('login', [UserAuthController::class,'login']);
    Route::post('register', [UserAuthController::class,'register']);
    
    
});
Route:: middleware(['auth:user'])->group(function(){
    Route::post('logout', [UserAuthController::class,'logout']);
    Route::get('me', [UserAuthController::class,'me']);
    Route::post('refresh', [UserAuthController::class,'refresh']);

});




Route::group(['prefix' => 'admin'], function () {
    Route::post('login', [AdminAuthController::class, 'login']);
});

Route::middleware(['auth:admin'])->group(function(){
    Route::post('logout', [AdminAuthController::class,'logout']);
    Route::post('me', [AdminAuthController::class,'me']);
    Route::post('refresh', [AdminAuthController::class,'refresh']);
});

//  construction api routes
Route::get('index',[constructionController::class,'index']);
Route::post('store',[constructionController::class,'store']);
Route::delete('delete/{id}',[constructionController::class,'delete']);
Route::post('update/{id}',[constructionController::class,'update']);
Route::get('edit/{id}',[constructionController::class,'edit']);