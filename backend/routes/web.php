<?php

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
    Route::post('/updateEmail', \App\Http\Actions\User\UpdateEmailAction::class)->name('ChangeEmail');
    Route::post('/updatePassWord', \App\Http\Actions\User\UpdatePasswordAction::class)->name('ChangePassWord');
    Route::post('/updateUserName', \App\Http\Actions\User\UpdateUserNameAction::class)->name('ChangeUserName');
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
        Route::get('/security', \App\Http\Actions\ShowSecurityAction::class)->name('ShowSecurity');
    });


    /**
     * 統計関連
     */

    //統計
    Route::get('/statistics/home', \App\Http\Actions\Statistic\ShowStatisticAction::class)->name('ShowStatistic');
    Route::get('/statistics/settings', \App\Http\Actions\Statistic\ShowSettingAction::class)->name('ShowStatisticSetting');
    //統計自体の更新
    Route::post('/statistic/create/all', \App\Http\Actions\Statistic\CreateAllStatisticAction::class)->name('CreateAllStatistic');
    Route::post('/statistic/update/all', \App\Http\Actions\Statistic\UpdateAllStatisticAction::class)->name('UpdateAllStatistic');
    //customNERまわり
    Route::post('/statistics/settings/named_entity/custom/create',  \App\Http\Actions\CustomNER\CreateCNERAction::class)->name('createCustomNamedEntity');
    Route::post('/statistics/settings/named_entity/custom/update',  \App\Http\Actions\CustomNER\UpdateCNERAction::class)->name('updateCustomNamedEntity');
    Route::post('/statistics/settings/named_entity/custom/delete',  \App\Http\Actions\CustomNER\DeleteCNERAction::class)->name('deleteCustomNamedEntity');
    //固有表現のインポート・エクスポートを検討

    //ユーザーのパッケージ周り
    Route::post('/statistics/settings/packages/use',  \App\Http\Actions\NlpPackageUser\UsePackageAction::class)->name('UsePackages');
    Route::post('/statistics/settings/packages/release',  \App\Http\Actions\NlpPackageUser\ReleasePackageAction::class)->name('ReleasePackages');

    //ユーザー通知周り→bladeで使用
    Route::post('/notification/user_rank/remove',  \App\Http\Actions\User\Notification\RemoveUserRankNoticeAction::class)->name('removeUser_rankInfo');
    Route::post('/notification/osirase/remove',  \App\Http\Actions\User\Notification\RemoveOsiraseNoticeAction::class)->name('removeOsiraseInfo');
    Route::post('/notification/releasenote/remove',  \App\Http\Actions\User\Notification\RemoveReleaseNoteNoticeAction::class)->name('removeReleasenoteInfo');


    /**
     * 管理者関連
     */
    Route::middleware(['administrator'])->group(function () {
        //管理者ページ
        Route::get('/administrator', \App\Http\Actions\ShowAdminHomeAction::class)->name('ShowAdminHome');
        Route::get('/administrator/notification', \App\Http\Actions\ShowAdminNotificationAction::class)->name('ShowAdminNotification');
        Route::get('/administrator/package', \App\Http\Actions\ShowAdminPackageAction::class)->name('ShowAdminPackage');
        Route::get('/administrator/package/{packageId}', \App\Http\Actions\ShowAdminIndividualPackageAction::class)->name('ShowAdminIndividualPackage');
        Route::get('/administrator/role_rank', \App\Http\Actions\ShowAdminRoleRankAction::class)->name('ShowAdminRoleRank');

        //パッケージ名前系
        Route::post('/administrator/settings/packages/create', \App\Http\Actions\NlpPackageName\CreatePackageNameAction::class)->name('createPackages');
        Route::post('/administrator/settings/packages/update', \App\Http\Actions\NlpPackageName\UpdatePackageNameAction::class)->name('updatePackages');
        Route::post('/administrator/settings/packages/delete',  \App\Http\Actions\NlpPackageName\DeletePackageNameAction::class)->name('deletePackages');
        //パッケージジャンル
        Route::post('/administrator/settings/packages/genre/create',  \App\Http\Actions\NlpPackageGenre\CreatePackageGenreAction::class)->name('createPackagesGenre');
        Route::post('/administrator/settings/packages/genre/update',  \App\Http\Actions\NlpPackageGenre\UpdatePackageGenreAction::class)->name('updatePackagesGenre');
        Route::post('/administrator/settings/packages/genre/delete',  \App\Http\Actions\NlpPackageGenre\DeletePackageGenreAction::class)->name('deletePackagesGenre');

        //packageNERまわり
        Route::post('/statistics/settings/named_entity/package/create',  \App\Http\Actions\PackageNER\CreatePNERAction::class)->name('createPackageNamedEntity');
        Route::post('/statistics/settings/named_entity/package/update',  \App\Http\Actions\PackageNER\UpdatePNERAction::class)->name('updatePackageNamedEntity');
        Route::post('/statistics/settings/named_entity/package/delete',  \App\Http\Actions\PackageNER\DeletePNERAction::class)->name('deletePackageNamedEntity');

        //お知らせまわり
        Route::post('/administrator/settings/osirase/create',  \App\Http\Actions\Osirase\CreateOsiraseAction::class)->name('createOsirase');
        Route::post('/administrator/settings/osirase/update',  \App\Http\Actions\Osirase\UpdateOsiraseAction::class)->name('updateOsirase');
        Route::post('/administrator/settings/osirase/delete',  \App\Http\Actions\Osirase\DeleteOsiraseAction::class)->name('deleteOsirase');

        //リリースノートまわり
        Route::post('/administrator/settings/releasenote/create',  \App\Http\Actions\ReleaseNote\CreateReleaseNoteAction::class)->name('createReleasenote');
        Route::post('/administrator/settings/releasenote/update',  \App\Http\Actions\ReleaseNote\UpdateReleaseNoteAction::class)->name('updateReleasenote');
        Route::post('/administrator/settings/releasenote/delete',  \App\Http\Actions\ReleaseNote\DeleteReleaseNoteAction::class)->name('deleteReleasenote');

        //ユーザーロールまわり
        Route::post('/administrator/settings/user/role/create',  \App\Http\Actions\UserRole\CreateUserRoleAction::class)->name('createUser_role');
        Route::post('/administrator/settings/user/role/update',  \App\Http\Actions\UserRole\UpdateUserRoleAction::class)->name('updateUser_role');
        Route::post('/administrator/settings/user/role/delete',  \App\Http\Actions\UserRole\DeleteUserRoleAction::class)->name('deleteUser_role');

        //ユーザーランクまわり
        Route::post('/administrator/settings/user/rank/create',  \App\Http\Actions\UserRank\CreateUserRankAction::class)->name('createUser_rank');
        Route::post('/administrator/settings/user/rank/update',  \App\Http\Actions\UserRank\UpdateUserRankAction::class)->name('updateUser_rank');
        Route::post('/administrator/settings/user/rank/delete',  \App\Http\Actions\UserRank\DeleteUserRankAction::class)->name('deleteUser_rank');
    });
});
