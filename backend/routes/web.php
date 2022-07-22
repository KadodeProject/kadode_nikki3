<?php

use App\Http\Controllers\admin\HomeAdminController;
use App\Http\Controllers\admin\NotificationBroadcasterAdminController;
use App\Http\Controllers\admin\packages\ShowIndividualPackage;
use App\Http\Controllers\admin\packages\ShowPackageAdminController;
use App\Http\Controllers\admin\Role_rankAdminController;
use App\Http\Controllers\diary\ExportDiaryController;
use App\Http\Controllers\diary\ImportDiaryController;
use App\Http\Controllers\diary\SearchDiaryController;
use App\Http\Controllers\notifications\ManageNotificationController;
use App\Http\Controllers\notifications\OsiraseController;
use App\Http\Controllers\notifications\ReleasenoteController;
use App\Http\Controllers\packages\GenrePackagesController;
use App\Http\Controllers\packages\ManagePackagesController;
use App\Http\Controllers\packages\OwnPackagesController;
use App\Http\Controllers\security\ShowSecurityPageController;
use App\Http\Controllers\statistics\ExportStatisticsController;
use App\Http\Controllers\statistics\GenerateStatisticsController;
use App\Http\Controllers\statistics\ImportStatisticsController;
use App\Http\Controllers\statistics\NamedEntityStatisticsController;
use App\Http\Controllers\statistics\SettingsStatisticsController;
use App\Http\Controllers\statistics\ShowStatisticsController;
use App\Http\Controllers\user\User_rankController;
use App\Http\Controllers\user\User_roleController;
use App\Models\User_ip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', \App\Http\Actions\ShowTopAction::class)->name('ShowTop');
Route::get('/privacyPolicy', \App\Http\Actions\ShowPrivacyPolicyAction::class)->name('ShowPrivacyPolicy');
Route::get('/contact', \App\Http\Actions\ShowContactAction::class)->name('ShowContact');
Route::get('/terms', \App\Http\Actions\ShowTermsAction::class)->name('ShowTerms');
Route::get('/aboutThisSite', \App\Http\Actions\ShowAboutThisSiteAction::class)->name('ShowAboutThisSite');
Route::get('/teapot', \App\Http\Actions\ShowTeapotAction::class)->name('ShowTeapot');
//DBアクセス絡むもの
Route::get('/osirase', \App\Http\Actions\Osirase\ShowOsiraseAction::class)->name('ShowOsirase');
Route::get('/releaseNote', \App\Http\Actions\ReleaseNote\ShowReleaseNoteAction::class)->name('ShowReleaseNote');


/**
 * ログイン時閲覧できるリンク
 * @todo ログインでここ必ず通るからこうなってるんだけど、すごく分かりにくいコードなのでなんとかしたい
 */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function (Request $request) {
    $ip = $request->ip();
    $geo = geoip()->getLocation($ip);
    $data = [
        "user_id" => Auth::id(),
        "ip" => $ip,
        "ua" => $request->header('User-Agent'),
        "geo" => $geo->country . "_" . $geo->city,
    ];
    User_ip::create($data);
    return redirect('/home ');
})->name('home_redirect');


/**
 * 認証
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    //ユーザー操作
    Route::get('/settings', \App\Http\Actions\ShowSettingsAction::class)->name('ShowSetting');
    Route::post('/updateEmail', \App\Http\Actions\User\ChangeEmailAction::class)->name('ChangeEmail');
    Route::post('/updatePassWord', \App\Http\Actions\User\ChangePasswordAction::class)->name('ChangePassWord');
    Route::post('/updateUserName', \App\Http\Actions\User\ChangeUserNameAction::class)->name('ChangeUserName');
    Route::post('/deleteUser', \App\Http\Actions\User\DeleteUserAction::class)->name('DeleteUser');


    /**
     * 日記関連
     */
    //ホーム
    Route::get('/home', \App\Http\Actions\ShowHomeAction::class)->name('ShowHome');

    //日記のCRUD
    Route::get('/edit', \App\Http\Actions\Diary\ShowCreateDiaryAction::class)->name('CreateDiary');
    Route::get('/edit/{uuid}',\App\Http\Actions\Diary\ShowSingleDiaryAction::class)->name('edit');

    Route::post('/create', \App\Http\Actions\Diary\CreateDiaryAction::class)->name('CreateDiary');
    Route::post('/update', \App\Http\Actions\Diary\UpdateDiaryAction::class)->name('UpdateDiary');
    Route::post('/delete', \App\Http\Actions\Diary\DeleteDiaryAction::class)->name('DeleteDiary');
    //日記閲覧
    Route::get('/diary/{year}/{month}', \App\Http\Actions\Diary\ShowMonthDiaryAction::class)->name('ShowMonthDiary');
    Route::get('/diary/{year}',  \App\Http\Actions\Diary\ShowYearDiaryAction::class)->name('ShowYearDiary');
    //検索
    Route::post('/search', \App\Http\Actions\Diary\Search\SimpleSearchAction::class)->name('SimpleSearch');
    Route::get('/search', \App\Http\Actions\Diary\Search\ShowSimpleSearchAction::class)->name('ShowSimpleSearch');
    //日記の入出力
    Route::post('/import/diary/kadode', \App\Http\Actions\Diary\Import\ImportFromKadodeCsvAction::class)->name('ImportFromKadodeCsv');
    Route::post('/import/diary/tukini', \App\Http\Actions\Diary\Import\ImportFromTukiniTxtAction::class)->name('ImportFromTukiniTxt');
    Route::post('/export/diary', \App\Http\Actions\Diary\Export\ExportByCsvAction::class)->name('ExportByCsv');
    //セキュリティ
    Route::middleware(['password.confirm'])->group(function () {
        Route::get('/security', ShowSecurityPageController::class)->name('security');
    });


    /**
     * 統計関連
     */

    //統計
    Route::get('/statistics/home', ShowStatisticsController::class)->name('showStatics');
    Route::get('/statistics/settings', [SettingsStatisticsController::class, "get"])->name('customStatics');
    //統計自体の更新
    Route::post('/makeStatistics', [GenerateStatisticsController::class, "create"])->name('makeStatics');
    Route::post('/updateStatistics', [GenerateStatisticsController::class, "update"])->name('updateStatics');
    //customNERまわり
    Route::post('/statistics/settings/named_entity/custom/create',  [NamedEntityStatisticsController::class, "customCreate"])->name('createCustomNamedEntity');
    Route::post('/statistics/settings/named_entity/custom/update',  [NamedEntityStatisticsController::class, "customUpdate"])->name('updateCustomNamedEntity');
    Route::post('/statistics/settings/named_entity/custom/delete',  [NamedEntityStatisticsController::class, "customDelete"])->name('deleteCustomNamedEntity');
    // //固有表現の入出力
    Route::post('/import/statistics/namedEntity', [ImportStatisticsController::class, "namedEntity"])->name('importNE');
    Route::post('/export/statistics/namedEntity', [ExportStatisticsController::class, "namedEntity"])->name('exportNE');


    //ユーザーのパッケージ周り
    Route::post('/statistics/settings/packages/use',  [OwnPackagesController::class, "use"])->name('usePackages');
    Route::post('/statistics/settings/packages/release',  [OwnPackagesController::class, "release"])->name('releasePackages');

    //ユーザー通知周り
    Route::post('/notification/user_rank/delete',  [ManageNotificationController::class, "user_rank"])->name('removeUser_rankInfo');
    Route::post('/notification/osirase/delete',  [ManageNotificationController::class, "osirase"])->name('removeOsiraseInfo');
    Route::post('/notification/releasenote/delete',  [ManageNotificationController::class, "releasenote"])->name('removeReleasenoteInfo');


    /**
     * 管理者関連
     */
    Route::middleware(['administrator'])->group(function () {
        //管理者ページ
        Route::get('/administrator', HomeAdminController::class)->name('home');
        Route::get('/administrator/notification', NotificationBroadcasterAdminController::class)->name('notification');
        Route::get('/administrator/package', ShowPackageAdminController::class)->name('package');
        Route::get('/administrator/package/{packageId}', ShowIndividualPackage::class)->name('packageIndividual');
        Route::get('/administrator/role_rank', Role_rankAdminController::class)->name('role');

        //パッケージ名前系
        Route::post('/administrator/settings/packages/create',  [ManagePackagesController::class, "create"])->name('createPackages');
        Route::post('/administrator/settings/packages/update',  [ManagePackagesController::class, "update"])->name('updatePackages');
        Route::post('/administrator/settings/packages/delete',  [ManagePackagesController::class, "delete"])->name('deletePackages');
        //パッケージジャンル
        Route::post('/administrator/settings/packages/genre/create',  [GenrePackagesController::class, "create"])->name('createPackagesGenre');
        Route::post('/administrator/settings/packages/genre/update',  [GenrePackagesController::class, "update"])->name('updatePackagesGenre');
        Route::post('/administrator/settings/packages/genre/delete',  [GenrePackagesController::class, "delete"])->name('deletePackagesGenre');

        //packageNERまわり
        Route::post('/statistics/settings/named_entity/package/create',  [NamedEntityStatisticsController::class, "packagesCreate"])->name('createPackageNamedEntity');
        Route::post('/statistics/settings/named_entity/package/update',  [NamedEntityStatisticsController::class, "packagesUpdate"])->name('updatePackageNamedEntity');
        Route::post('/statistics/settings/named_entity/package/delete',  [NamedEntityStatisticsController::class, "packagesDelete"])->name('deletePackageNamedEntity');

        //お知らせまわり
        Route::post('/administrator/settings/osirase/create',  [OsiraseController::class, "create"])->name('createOsirase');
        Route::post('/administrator/settings/osirase/update',  [OsiraseController::class, "update"])->name('updateOsirase');
        Route::post('/administrator/settings/osirase/delete',  [OsiraseController::class, "delete"])->name('deleteOsirase');

        //リリースノートまわり
        Route::post('/administrator/settings/releasenote/create',  [ReleasenoteController::class, "create"])->name('createReleasenote');
        Route::post('/administrator/settings/releasenote/update',  [ReleasenoteController::class, "update"])->name('updateReleasenote');
        Route::post('/administrator/settings/releasenote/delete',  [ReleasenoteController::class, "delete"])->name('deleteReleasenote');

        //ユーザーロールまわり
        Route::post('/administrator/settings/user/role/create',  [User_roleController::class, "create"])->name('createUser_role');
        Route::post('/administrator/settings/user/role/update',  [User_roleController::class, "update"])->name('updateUser_role');
        Route::post('/administrator/settings/user/role/delete',  [User_roleController::class, "delete"])->name('deleteUser_role');

        //ユーザーランクまわり
        Route::post('/administrator/settings/user/rank/create',  [User_rankController::class, "create"])->name('createRUser_rank');
        Route::post('/administrator/settings/user/rank/update',  [User_rankController::class, "update"])->name('updateRUser_rank');
        Route::post('/administrator/settings/user/rank/delete',  [User_rankController::class, "delete"])->name('deleteRUser_rank');
    });
});
