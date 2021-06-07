<?php

use App\Http\Controllers\Api\AuthController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::name('frontend.')->middleware(['auth:sanctum'])->group(function(){
    Route::post('/search/batch/post', 'Frontend\BatchSearchController@CollectFromPost')->name('search.batch.post.collect');
    Route::post('/search/batch/response', 'Frontend\BatchSearchController@UsersDetailsResponse')->name('search.batch.response');
});

Route::post('login', [AuthController::class, 'login'])->name('frontend.login');
