<?php

use App\Http\Controllers\diary\DashboardDiaryController;
use App\Http\Controllers\diary\EditDiaryController;
use App\Http\Controllers\diary\ExportDiaryController;
use App\Http\Controllers\diary\ImportDiaryController;
use App\Http\Controllers\diary\SearchDiaryController;
use App\Http\Controllers\diary\SettingDiaryController;
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
    return view('diary');
})->name('dashboard_redirect');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/diary', DashboardDiaryController::class)->name('dashboard');
    Route::get('/diary/setting', SettingDiaryController::class)->name('setting');
    //日記のCRUD
    Route::get('/diary/edit/{uuid}', [EditDiaryController::class,"get"])->name('edit');
    Route::post('/diary/edit/{uuid}', [EditDiaryController::class,"post"])->name('new');
    Route::put('/diary/edit/{uuid}', [EditDiaryController::class,"update"])->name('update');
    Route::delete('/diary/edit/{uuid}', [EditDiaryController::class,"delete"])->name('delete');
    //閲覧
    Route::get('/diary/{year}/{month}', ShowDiaryController::class)->name('show');
    Route::get('/diary/search', SearchDiaryController::class)->name('search');
    Route::get('/diary/statistics', StatisticsDiaryController::class)->name('statics');
    //入出力
    Route::post('/diary/import', ImportDiaryController::class)->name('import');
    Route::get('/diary/export', ExportDiaryController::class)->name('export');

});