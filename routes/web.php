<?php

use App\Http\Controllers\Admin\AgentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\BatchSearchController;
use App\Http\Controllers\Frontend\FbUsersController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\MasterController;
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
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('search', [FbUsersController::class,'search'])->name('search');
    Route::get('search/details/{fb_id}', [FbUsersController::class,'userDetails'])->name('search.details');

    // Batch search
    Route::get('search/batch/post', [BatchSearchController::class, 'postSearch'])->name('search.batch.post');
    Route::get('search/batch/group', [BatchSearchController::class, 'groupSearch'])->name('search.batch.group');

    // Download Facebook Collector Tool Link
    Route::get('downloads/facebook-collector', [HomeController::class, 'downloadFacebookCollector'])->name('downloads.facebook_collector');
    Route::get('downloads/facebook-collector/download', [HomeController::class, 'downloadFb'])->name('download.facebook_collector.download');
    Route::get('downloads/facebook-collector/documentation', [HomeController::class, 'downloadFacebookCollectorDocumentation'])->name('download.facebook_collector.documentation');
});

/*
 * ==================================================
 * ADMIN ROUTES
 * ==================================================
 */
Route::name('admin.')->prefix('admin')->middleware(['web', 'auth', 'is_admin'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Agents
    Route::middleware(['is_authorized'])->group(function () {
        Route::get('agents', [AgentsController::class, 'index'])->name('agents');
        Route::get('agents/create', [AgentsController::class, 'create'])->name('agents.create');
        Route::post('agents', [AgentsController::class, 'store'])->name('agents.store');
        Route::get('agents/{agent_id}/edit', [AgentsController::class, 'edit'])->name('agents.edit');
        Route::patch('agents/{agent_id}/edit', [AgentsController::class, 'update'])->name('agents.update');
        Route::get('agents/{agent_id}/delete', [AgentsController::class, 'delete'])->name('agents.delete');
        // Agent Reports
        Route::get('agents/report/{agent_id}', [AgentsController::class, 'report'])->name('agents.report');
    });
});

Route::get('inactive_agent', [MasterController::class, 'inactive_agent_redirect'])->name('inactive.agent');
Auth::routes();

