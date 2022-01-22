<?php

use App\Http\Controllers\diary\HomeDiaryController;
use App\Http\Controllers\diary\EditDiaryController;
use App\Http\Controllers\diary\ExportDiaryController;
use App\Http\Controllers\diary\ImportDiaryController;
use App\Http\Controllers\diary\SearchDiaryController;
use App\Http\Controllers\diary\SettingDiaryController;
use App\Http\Controllers\diary\ShowDiaryController;

use App\Http\Controllers\notifications\OsiraseController;
use App\Http\Controllers\notifications\ReleasenoteController;
use App\Http\Controllers\notifications\ManageNotificationController;

use App\Http\Controllers\user\User_roleController;
use App\Http\Controllers\user\User_rankController;


use App\Http\Controllers\security\UpdateUserInfoController;
use App\Http\Controllers\security\ShowSecurityPageController;

use App\Http\Controllers\statistics\ShowStatisticsController;
use App\Http\Controllers\statistics\SettingsStatisticsController;
use App\Http\Controllers\statistics\ImportStatisticsController;
use App\Http\Controllers\statistics\ExportStatisticsController;
use App\Http\Controllers\statistics\GenerateStatisticsController;
use App\Http\Controllers\statistics\NamedEntityStatisticsController;

use App\Http\Controllers\admin\HomeAdminController;
use App\Http\Controllers\admin\NotificationBroadcasterAdminController;
use App\Http\Controllers\admin\PackageAdminController;
use App\Http\Controllers\admin\Role_rankAdminController;

use App\Http\Controllers\packages\GenrePackagesController;
use App\Http\Controllers\packages\ManagePackagesController;
use App\Http\Controllers\packages\OwnPackagesController;

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




Route::get('/news', [OsiraseController::class,"read"])->name('releasenote');
Route::get('/releasenote', [ReleasenoteController::class,"read"])->name('releasenote');

Route::get('/terms', function () {
    return view('diaryNoLogIn/terms');
});
Route::get('/aboutThisSite', function () {
    return view('diaryNoLogIn/aboutThisSite');
});
Route::get('/teapot', function () {
    abort(418);
});


/**
 * ログイン時閲覧できるリンク
 */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home ');
})->name('home_redirect');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    /**
     * ユーザー関連
     */
    //ユーザー操作
    Route::get('/settings', SettingDiaryController::class)->name('setting');
    Route::post('/updateEmail', [UpdateUserInfoController::class,"updateEmail"])->name('updateEmail');
    Route::post('/updatePassWord', [UpdateUserInfoController::class,"updatePassWord"])->name('updatePassWord');
    Route::post('/deleteUser', [UpdateUserInfoController::class,"deleteUser"])->name('deleteUser');


    /**
     * 日記関連
     */
    //ホーム
    Route::get('/home', HomeDiaryController::class)->name('home');

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
    //セキュリティ
    Route::get('/security', ShowSecurityPageController::class)->name('security');


    /**
     * 統計関連
     */

    //統計
    Route::get('/statistics/home', ShowStatisticsController::class)->name('showStatics');
    Route::get('/statistics/settings', [SettingsStatisticsController::class,"get"])->name('customStatics');
    //統計自体の更新
    Route::post('/makeStatistics', [GenerateStatisticsController::class,"create"])->name('makeStatics');
    Route::post('/updateStatistics',[GenerateStatisticsController::class,"update"])->name('updateStatics');
    //customNERまわり
    Route::post('/statistics/settings/named_entity/custom/create',  [NamedEntityStatisticsController::class,"customCreate"])->name('createCustomNamedEntity');
    Route::post('/statistics/settings/named_entity/custom/update',  [NamedEntityStatisticsController::class,"customUpdate"])->name('updateCustomNamedEntity');
    Route::post('/statistics/settings/named_entity/custom/delete',  [NamedEntityStatisticsController::class,"customDelete"])->name('deleteCustomNamedEntity');
    // //固有表現の入出力
    Route::post('/import/statistics/namedEntity', [ImportStatisticsController::class,"namedEntity"])->name('importNE');
    Route::post('/export/statistics/namedEntity', [ExportStatisticsController::class,"namedEntity"])->name('exportNE');


    //ユーザーのパッケージ周り
    Route::post('/statistics/settings/packages/use',  [OwnPackagesController::class,"use"])->name('usePackages');
    Route::post('/statistics/settings/packages/release',  [OwnPackagesController::class,"release"])->name('releasePackages');

    //ユーザー通知周り
    Route::post('/notification/user_rank/delete',  [ManageNotificationController::class,"user_rank"])->name('removeUser_rankInfo');
    Route::post('/notification/osirase/delete',  [ManageNotificationController::class,"osirase"])->name('removeOsiraseInfo');
    Route::post('/notification/releasenote/delete',  [ManageNotificationController::class,"releasenote"])->name('removeReleasenoteInfo');




});

Route::middleware(['administrator'])->group(function () {
    /**
     * 管理者関連
     */
    //管理者ページ
    Route::get('/administrator', HomeAdminController::class)->name('home');
    Route::get('/administrator/notification', NotificationBroadcasterAdminController::class)->name('notification');
    Route::get('/administrator/package',PackageAdminController::class)->name('package');
    Route::get('/administrator/role_rank', Role_rankAdminController::class)->name('role');

    //パッケージ名前系
    Route::post('/administrator/settings/packages/create',  [ManagePackagesController::class,"create"])->name('createPackages');
    Route::post('/administrator/settings/packages/update',  [ManagePackagesController::class,"update"])->name('updatePackages');
    Route::post('/administrator/settings/packages/delete',  [ManagePackagesController::class,"delete"])->name('deletePackages');
    //パッケージジャンル
    Route::post('/administrator/settings/packages/genre/create',  [GenrePackagesController::class,"create"])->name('createPackagesGenre');
    Route::post('/administrator/settings/packages/genre/update',  [GenrePackagesController::class,"update"])->name('updatePackagesGenre');
    Route::post('/administrator/settings/packages/genre/delete',  [GenrePackagesController::class,"delete"])->name('deletePackagesGenre');

    //packageNERまわり
    Route::post('/statistics/settings/named_entity/package/create',  [NamedEntityStatisticsController::class,"packagesCreate"])->name('createPackageNamedEntity');
    Route::post('/statistics/settings/named_entity/package/update',  [NamedEntityStatisticsController::class,"packagesUpdate"])->name('updatePackageNamedEntity');
    Route::post('/statistics/settings/named_entity/package/delete',  [NamedEntityStatisticsController::class,"packagesDelete"])->name('deletePackageNamedEntity');

    //お知らせまわり
    Route::post('/administrator/settings/osirase/create',  [OsiraseController::class,"create"])->name('createOsirase');
    Route::post('/administrator/settings/osirase/update',  [OsiraseController::class,"update"])->name('updateOsirase');
    Route::post('/administrator/settings/osirase/delete',  [OsiraseController::class,"delete"])->name('deleteOsirase');

    //リリースノートまわり
    Route::post('/administrator/settings/releasenote/create',  [ReleasenoteController::class,"create"])->name('createReleasenote');
    Route::post('/administrator/settings/releasenote/update',  [ReleasenoteController::class,"update"])->name('updateReleasenote');
    Route::post('/administrator/settings/releasenote/delete',  [ReleasenoteController::class,"delete"])->name('deleteReleasenote');

    //ユーザーロールまわり
    Route::post('/administrator/settings/user/role/create',  [User_roleController::class,"create"])->name('createUser_role');
    Route::post('/administrator/settings/user/role/update',  [User_roleController::class,"update"])->name('updateUser_role');
    Route::post('/administrator/settings/user/role/delete',  [User_roleController::class,"delete"])->name('deleteUser_role');

    //ユーザーランクまわり
    Route::post('/administrator/settings/user/rank/create',  [User_rankController::class,"create"])->name('createRUser_rank');
    Route::post('/administrator/settings/user/rank/update',  [User_rankController::class,"update"])->name('updateRUser_rank');
    Route::post('/administrator/settings/user/rank/delete',  [User_rankController::class,"delete"])->name('deleteRUser_rank');


});