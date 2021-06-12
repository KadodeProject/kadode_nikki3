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




/**
 * 未ログインでも閲覧できるページ
 */
Route::get('/', function () {
    return view('diaryNoLogIn/top');
});
Route::get('/privacyPolicy', function () {
    return view('diaryNoLogIn/privacyPolicy');
});
Route::get('/aboutThisPage', function () {
    return view('diaryNoLogIn/aboutThisPage');
});
Route::get('/contact', function () {
    return view('diaryNoLogIn/contact');
});
Route::get('/news', function () {
    return view('diaryNoLogIn/news');
});


/**
 * ログイン時閲覧できるリンク
 */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home ');
})->name('home_redirect');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', HomeDiaryController::class)->name('home');
    Route::get('/settings', SettingDiaryController::class)->name('setting');
    //日記のCRUD
    Route::get('/edit/{uuid}', [EditDiaryController::class,"get"])->name('edit');
    Route::post('/create', [EditDiaryController::class,"create"])->name('new');
    Route::post('/update', [EditDiaryController::class,"update"])->name('update');
    Route::post('/delete', [EditDiaryController::class,"delete"])->name('delete');
    //閲覧
    Route::get('/diary/{year}/{month}', [ShowDiaryController::class,"getMonthArchive"])->name('show');
    Route::get('/diary/{year}',  [ShowDiaryController::class,"getYearArchive"])->name('show');
    Route::post('/search', [SearchDiaryController::class,"post"])->name('search');
    Route::get('/search', [SearchDiaryController::class,"showSearch"])->name('searchConsole');
    // Route::get('/search',[ SearchDiaryController::class,"showSearch"])->name('search');
    //入出力
    Route::post('/import/kadode', [ImportDiaryController::class,"kadode"])->name('importKadode');
    Route::post('/import/tukini', [ImportDiaryController::class,"tukini"])->name('importTukini');
    Route::get('/export', ExportDiaryController::class)->name('export');
    Route::get('/export', ExportDiaryController::class)->name('export');
    //統計
    Route::get('/statistics', StatisticsDiaryController::class)->name('statics');



});