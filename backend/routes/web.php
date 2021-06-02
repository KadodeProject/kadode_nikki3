<?php

use App\Http\Controllers\diary\HomeDiaryController;
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
Route::get('/diary', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home ');
})->name('home_redirect');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', HomeDiaryController::class)->name('home');
    Route::get('/setting', SettingDiaryController::class)->name('setting');
    //日記のCRUD
    Route::get('/edit/{uuid}', [EditDiaryController::class,"get"])->name('edit');
    Route::post('/create', [EditDiaryController::class,"create"])->name('new');
    Route::post('/update', [EditDiaryController::class,"update"])->name('update');
    Route::post('/delete', [EditDiaryController::class,"delete"])->name('delete');
    //閲覧
    Route::get('/{year}/{month}', [ShowDiaryController::class,"getMonthArchive"])->name('show');
    Route::get('/{year}',  [ShowDiaryController::class,"getYearArchive"])->name('show');
    Route::get('/search', SearchDiaryController::class)->name('search');
    Route::get('/statistics', StatisticsDiaryController::class)->name('statics');
    //入出力
    Route::post('/import', ImportDiaryController::class)->name('import');
    Route::get('/export', ExportDiaryController::class)->name('export');

});