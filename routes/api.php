<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloraController;
use App\Http\Controllers\FaunaController;
use App\Http\Controllers\TranslateController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Flora
Route::group(['prefix' => 'flora', 'as' => 'flora'], function () {
  Route::get('/', [FloraController::class, 'index']);
  Route::post('/', [FloraController::class, 'store']);
});
// Fauna
Route::group(['prefix' => 'fauna', 'as' => 'fauna'], function () {
  Route::get('/', [FaunaController::class, 'index']);
  Route::post('/', [FaunaController::class, 'store']);
});
// Translate
Route::group(['prefix' => 'translate', 'as' => 'translate'], function () {
  Route::post('/', [TranslateController::class, 'index']);
});
