<?php

use App\Http\Controllers\diary\DashboardDiaryController;
use App\Http\Controllers\diary\EditDiaryController;
use App\Http\Controllers\diary\ExportDiaryController;
use App\Http\Controllers\diary\ImportDiaryController;
use App\Http\Controllers\diary\SearchDiaryController;
use App\Http\Controllers\diary\ShowDiaryController;
use App\Http\Controllers\diary\StatisticsDiaryController;
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
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/diary', DashboardDiaryController::class)->name('dashboard');
    Route::get('/diary/edit', EditDiaryController::class)->name('edit');
    Route::get('/diary/{year}/{month}', ShowDiaryController::class)->name('show');
    Route::get('/diary/{keyword}', SearchDiaryController::class)->name('search');
    Route::get('/diary/statistics', StatisticsDiaryController::class)->name('statics');
    Route::get('/diary/import', ImportDiaryController::class)->name('import');
    Route::get('/diary/export', ExportDiaryController::class)->name('export');

});