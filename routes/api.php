<?php
use App\Http\Controllers\VetController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthenticationController::class, 'me']);
    Route::post('/logout',[AuthenticationController::class, 'logout']);

    Route::post('/vets/search', [VetController::class, 'search']);
    Route::post('/vets', [VetController::class, 'store']);
    Route::get('/vets', [VetController::class, 'index']);

    Route::group(['middleware'=>'owner'], function(){
        Route::get('/vets/{vet}', [VetController::class, 'show']);
        Route::put('/vets/{vet}', [VetController::class, 'update']);
        Route::delete('/vets/{vet}', [VetController::class, 'destroy']);
    });
   
});
