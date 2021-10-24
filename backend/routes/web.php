<?php

use App\Http\Controllers\diary\HomeDiaryController;
use App\Http\Controllers\diary\EditDiaryController;
use App\Http\Controllers\diary\ExportDiaryController;
use App\Http\Controllers\diary\ImportDiaryController;
use App\Http\Controllers\diary\SearchDiaryController;
use App\Http\Controllers\diary\SettingDiaryController;
use App\Http\Controllers\diary\ShowDiaryController;
use App\Http\Controllers\diary\UserController;
use App\Http\Controllers\statistics\ShowStatisticsController;
use App\Http\Controllers\statistics\MakeStatisticsController;
use App\Http\Controllers\statistics\UpdateStatisticsController;
use App\Http\Controllers\statistics\SettingsStatisticsController;
use App\Http\Controllers\statistics\ImportStatisticsController;
use App\Http\Controllers\statistics\ExportStatisticsController;
use App\Http\Controllers\statistics\PackagesStatisticsController;
use App\Http\Controllers\statistics\GenerateStatisticsController;
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
Route::get('/contact', function () {
    return view('diaryNoLogIn/contact');
});
Route::get('/news', function () {
    return view('diaryNoLogIn/news');
});
Route::get('/releaseNote', function () {
    return view('diaryNoLogIn/releaseNote');
});
Route::get('/terms', function () {
    return view('diaryNoLogIn/terms');
});
Route::get('/aboutThisSite', function () {
    return view('diaryNoLogIn/aboutThisSite');
});


/**
 * ログイン時閲覧できるリンク
 */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home ');
})->name('home_redirect');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', HomeDiaryController::class)->name('home');
    //ユーザー操作
    Route::get('/settings', SettingDiaryController::class)->name('setting');
    Route::post('/updateEmail', [UserController::class,"updateEmail"])->name('updateEmail');
    Route::post('/updatePassWord', [UserController::class,"updatePassWord"])->name('updatePassWord');
    Route::post('/deleteUser', [UserController::class,"deleteUser"])->name('deleteUser');
    //日記のCRUD
    Route::get('/edit', [EditDiaryController::class,"newPage"])->name('newPage');
    Route::get('/edit/{uuid}', [EditDiaryController::class,"get"])->name('edit');

    Route::post('/create', [EditDiaryController::class,"create"])->name('new');
    Route::post('/update', [EditDiaryController::class,"update"])->name('update');
    Route::post('/delete', [EditDiaryController::class,"delete"])->name('delete');
    //日記閲覧
    Route::get('/diary/{year}/{month}', [ShowDiaryController::class,"getMonthArchive"])->name('show');
    Route::get('/diary/{year}',  [ShowDiaryController::class,"getYearArchive"])->name('show');
    //検索
    Route::post('/search', [SearchDiaryController::class,"post"])->name('search');
    Route::get('/search', [SearchDiaryController::class,"showSearch"])->name('searchConsole');
    // Route::get('/search',[ SearchDiaryController::class,"showSearch"])->name('search');
    //日記の入出力
    Route::post('/import/diary/kadode', [ImportDiaryController::class,"kadode"])->name('importKadode');
    Route::post('/import/diary/tukini', [ImportDiaryController::class,"tukini"])->name('importTukini');
    Route::post('/export/diary', ExportDiaryController::class)->name('export');
    //統計
    Route::get('/statistics/home', ShowStatisticsController::class)->name('showStatics');
    Route::get('/statistics/settings', [SettingsStatisticsController::class,"get"])->name('customStatics');
    //統計自体の更新
    Route::post('/makeStatistics', [GenerateStatisticsController::class,"create"])->name('makeStatics');
    Route::post('/updateStatistics',[GenerateStatisticsController::class,"update"])->name('updateStatics');
    //NEユーザー定義設定更新
    Route::post('/statistics/settings/named_entity/create',  [SettingsStatisticsController::class,"create"])->name('createNamedEntity');
    Route::post('/statistics/settings/named_entity/update',  [SettingsStatisticsController::class,"update"])->name('updateNamedEntity');
    Route::post('/statistics/settings/named_entity/delete',  [SettingsStatisticsController::class,"delete"])->name('deleteNamedEntity');
    //パッケージ周り
    Route::post('/statistics/settings/package/create',  [PackagesStatisticsController::class,"create"])->name('createPackages');
    Route::post('/statistics/settings/package/update',  [PackagesStatisticsController::class,"update"])->name('updatePackages');
    Route::post('/statistics/settings/package/delete',  [PackagesStatisticsController::class,"delete"])->name('deletePackages');
    Route::post('/statistics/settings/package/use',  [PackagesStatisticsController::class,"use"])->name('usePackages');
    Route::post('/statistics/settings/package/release',  [PackagesStatisticsController::class,"release"])->name('releasePackages');
    // //固有表現の入出力
    Route::post('/import/statistics/namedEntity', [ImportStatisticsController::class,"namedEntity"])->name('importNE');
    Route::post('/export/statistics/namedEntity', [ExportStatisticsController::class,"namedEntity"])->name('exportNE');


});