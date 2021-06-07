<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * ==================================================
 * FRONTEND ROUTES
 * ==================================================
 */
Route::name('frontend.')->middleware(['web', 'auth'])->group( function () {
    Route::get('/', 'Frontend\HomeController@index')->name('home');
    Route::get('search', 'Frontend\FbUsersController@search')->name('search');
    Route::get('search/details/{fb_id}', 'Frontend\FbUsersController@userDetails')->name('search.details');

    // Batch search
    Route::get('search/batch/post', 'Frontend\BatchSearchController@postSearch')->name('search.batch.post');
    Route::get('search/batch/group', 'Frontend\BatchSearchController@groupSearch')->name('search.batch.group');

});

/*
 * ==================================================
 * ADMIN ROUTES
 * ==================================================
 */
Route::name('admin.')->prefix('admin')->middleware(['web', 'auth', 'is_admin'])->group(function(){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

    // Agents
    Route::get('agents', 'Admin\AgentsController@index')->name('agents');
    Route::get('agents/create', 'Admin\AgentsController@create')->name('agents.create');
    Route::post('agents', 'Admin\AgentsController@store')->name('agents.store');
    Route::get('agents/{agent_id}', 'Admin\AgentsController@edit')->name('agents.edit');
    Route::patch('agents/{agent_id}', 'Admin\AgentsController@update')->name('agents.update');
    Route::get('agents/{agent_id}/delete', 'Admin\AgentsController@delete')->name('agents.delete');
});

Auth::routes();

