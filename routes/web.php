<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;

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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/dashboard', [DashboardController::class, 'render'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dashboard/filter', [DashboardController::class, 'getInfoForFilter'])
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/filter', [DashboardController::class, 'filterUsers'])
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/search', [DashboardController::class, 'searchUsers'])
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/charts', [DashboardController::class, 'getChartsInfo'])
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/charts/filter', [DashboardController::class, 'filterChartsInfo'])
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/export-users', [DashboardController::class, 'exportUsers'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
