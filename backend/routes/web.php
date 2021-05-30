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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::group(['auth:sanctum', 'verified'], function () {
    Route::get('/diary', [DashboardDiaryController::class])->name('dashboard');
    Route::get('/diary/edit', [EditDiaryController::class])->name('dashboard');
    Route::get('/diary/{year}/{month}', [ShowDiaryController::class])->name('dashboard');
    Route::get('/diary/{keyword}', [SearchDiaryController::class])->name('dashboard');
    Route::get('/diary/statistics', [StatisticsDiaryController::class])->name('dashboard');
    Route::get('/diary/import', [ImportDiaryController::class])->name('dashboard');
    Route::get('/diary/export', [ExportDiaryController::class])->name('dashboard');

});
