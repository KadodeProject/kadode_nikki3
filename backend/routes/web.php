<?php

declare(strict_types=1);

use App\Http\Actions;
use App\Models\UserIp;
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

// 未ログインでも閲覧できるページ
Route::get('/', Actions\ShowTopAction::class)->name('ShowTop');
Route::get('/privacyPolicy', Actions\ShowPrivacyPolicyAction::class)->name('ShowPrivacyPolicy');
Route::get('/contact', Actions\ShowContactAction::class)->name('ShowContact');
Route::get('/terms', Actions\ShowTermsAction::class)->name('ShowTerms');
Route::get('/aboutThisSite', Actions\ShowAboutThisSiteAction::class)->name('ShowAboutThisSite');
Route::get('/teapot', Actions\ShowTeapotAction::class)->name('ShowTeapot');
// DBアクセス絡むもの
Route::get('/osirase', Actions\Osirase\ShowOsiraseAction::class)->name('ShowOsirase');
Route::get('/releaseNote', Actions\ReleaseNote\ShowReleaseNoteAction::class)->name('ShowReleaseNote');

/*
 * ログイン時閲覧できるリンク
 * @todo ログインでここ必ず通るからこうなってるんだけど、すごく分かりにくいコードなのでなんとかしたい
 */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function (Request $request) {
    $ip = $request->ip();
    $geo = geoip()->getLocation($ip);
    $data = [
        'user_id' => Auth::id(),
        'ip'      => $ip,
        'ua'      => $request->header('User-Agent'),
        'geo'     => $geo->country.'_'.$geo->city,
    ];
    UserIp::create($data);

    return redirect(route('ShowHome'));
})->name('home_redirect');

// 認証
Route::middleware(['auth:sanctum', 'verified'])->group(function (): void {
    // ユーザー操作
    Route::get('/settings', Actions\ShowSettingsAction::class)->name('ShowSetting');
    Route::post('/updateEmail', Actions\User\UpdateEmailAction::class)->name('ChangeEmail');
    Route::post('/updatePassWord', Actions\User\UpdatePasswordAction::class)->name('ChangePassWord');
    Route::post('/updateUserName', Actions\User\UpdateUserNameAction::class)->name('ChangeUserName');
    Route::post('/deleteUser', Actions\User\DeleteUserAction::class)->name('DeleteUser');

    // 日記関連
    // ホーム
    Route::get('/home', Actions\ShowHomeAction::class)->name('ShowHome');

    // 日記のCRUD
    Route::get('/edit', Actions\Diary\ShowCreateDiaryAction::class)->name('ShowCreateDiary');
    Route::get('/edit/{uuid}', Actions\Diary\ShowSingleDiaryAction::class)->name('ShowSingleDiary');

    Route::post('/create', Actions\Diary\CreateDiaryAction::class)->name('CreateDiary');
    Route::post('/update', Actions\Diary\UpdateDiaryAction::class)->name('UpdateDiary');
    Route::post('/delete', Actions\Diary\DeleteDiaryAction::class)->name('DeleteDiary');
    // 日記閲覧
    Route::get('/diary/{year}/{month}', Actions\Diary\ShowMonthDiaryAction::class)->name('ShowMonthDiary');
    Route::get('/diary/{year}', Actions\Diary\ShowYearDiaryAction::class)->name('ShowYearDiary');
    // 検索
    Route::post('/search', Actions\Diary\Search\SimpleSearchAction::class)->name('SimpleSearch');
    Route::get('/search', Actions\Diary\Search\ShowSimpleSearchAction::class)->name('ShowSimpleSearch');
    // 日記のインポート
    Route::post('/import/diary/kadode', Actions\Diary\Import\ImportFromKadodeCsvAction::class)->name('ImportFromKadodeCsv');
    Route::post('/import/diary/tukini', Actions\Diary\Import\ImportFromTukiniTxtAction::class)->name('ImportFromTukiniTxt');
    // 日記のエクスポート
    Route::post('/export/diary/csv/sjis', Actions\Diary\Export\ExportByCsvSJisAction::class)->name('ExportByCsvSJis');
    Route::post('/export/diary/csv/utf8', Actions\Diary\Export\ExportByCsvUtf8Action::class)->name('ExportByCsvUtf8');
    // セキュリティ
    Route::middleware(['password.confirm'])->group(function (): void {
        Route::get('/security', Actions\ShowSecurityAction::class)->name('ShowSecurity');
    });

    // 統計関連

    // 統計
    Route::get('/statistics/home', Actions\Statistic\ShowStatisticAction::class)->name('ShowStatistic');
    Route::get('/statistics/settings', Actions\Statistic\ShowStatisticSettingAction::class)->name('ShowStatisticSetting');
    // 統計自体の更新
    Route::post('/statistic/create/all', Actions\Statistic\CreateAllStatisticAction::class)->name('CreateAllStatistic');
    Route::post('/statistic/update/all', Actions\Statistic\UpdateAllStatisticAction::class)->name('UpdateAllStatistic');
    // customNERまわり
    Route::post('/statistics/settings/named_entity/custom/create', Actions\CustomNER\CreateCNERAction::class)->name('CreateCNER');
    Route::post('/statistics/settings/named_entity/custom/update', Actions\CustomNER\UpdateCNERAction::class)->name('UpdateCNER');
    Route::post('/statistics/settings/named_entity/custom/delete', Actions\CustomNER\DeleteCNERAction::class)->name('DeleteCNER');
    // 固有表現のインポート・エクスポートを検討

    // ユーザーのパッケージ周り
    Route::post('/statistics/settings/packages/use', Actions\NlpPackageUser\UsePackageAction::class)->name('UsePackage');
    Route::post('/statistics/settings/packages/release', Actions\NlpPackageUser\ReleasePackageAction::class)->name('ReleasePackage');

    // ユーザー通知周り→bladeで使用
    Route::post('/notification/user_rank/remove', Actions\User\Notification\RemoveUserRankNoticeAction::class)->name('RemoveUserRankInfo');
    Route::post('/notification/osirase/remove', Actions\User\Notification\RemoveOsiraseNoticeAction::class)->name('RemoveOsiraseInfo');
    Route::post('/notification/releasenote/remove', Actions\User\Notification\RemoveReleaseNoteNoticeAction::class)->name('RemoveReleasenoteInfo');

    // 管理者関連
    Route::middleware(['administrator'])->group(function (): void {
        // 管理者ページ
        Route::get('/administrator', Actions\ShowAdminHomeAction::class)->name('ShowAdminHome');
        Route::get('/administrator/notification', Actions\ShowAdminNotificationAction::class)->name('ShowAdminNotification');
        Route::get('/administrator/package', Actions\ShowAdminPackageAction::class)->name('ShowAdminPackage');
        Route::get('/administrator/package/{packageId}', Actions\ShowAdminIndividualPackageAction::class)->name('ShowAdminIndividualPackage');
        Route::get('/administrator/role_rank', Actions\ShowAdminRoleRankAction::class)->name('ShowAdminRoleRank');
        Route::get('/administrator/phpinfo', Actions\ShowAdminPhpInfo::class)->name('ShowAdminPhpInfo');

        // パッケージ名前系
        Route::post('/administrator/settings/packages/create', Actions\NlpPackageName\CreatePackageNameAction::class)->name('CreatePackageName');
        Route::post('/administrator/settings/packages/update', Actions\NlpPackageName\UpdatePackageNameAction::class)->name('UpdatePackageName');
        Route::post('/administrator/settings/packages/delete', Actions\NlpPackageName\DeletePackageNameAction::class)->name('DeletePackageName');
        // パッケージジャンル
        Route::post('/administrator/settings/packages/genre/create', Actions\NlpPackageGenre\CreatePackageGenreAction::class)->name('CreatePackageGenre');
        Route::post('/administrator/settings/packages/genre/update', Actions\NlpPackageGenre\UpdatePackageGenreAction::class)->name('UpdatePackageGenre');
        Route::post('/administrator/settings/packages/genre/delete', Actions\NlpPackageGenre\DeletePackageGenreAction::class)->name('DeletePackageGenre');

        // packageNERまわり
        Route::post('/statistics/settings/named_entity/package/create', Actions\PackageNER\CreatePNERAction::class)->name('CreatePNERAction');
        Route::post('/statistics/settings/named_entity/package/update', Actions\PackageNER\UpdatePNERAction::class)->name('UpdatePNERAction');
        Route::post('/statistics/settings/named_entity/package/delete', Actions\PackageNER\DeletePNERAction::class)->name('DeletePNERAction');

        // お知らせまわり
        Route::post('/administrator/settings/osirase/create', Actions\Osirase\CreateOsiraseAction::class)->name('CreateOsirase');
        Route::post('/administrator/settings/osirase/update', Actions\Osirase\UpdateOsiraseAction::class)->name('UpdateOsirase');
        Route::post('/administrator/settings/osirase/delete', Actions\Osirase\DeleteOsiraseAction::class)->name('DeleteOsirase');

        // リリースノートまわり
        Route::post('/administrator/settings/releasenote/create', Actions\ReleaseNote\CreateReleaseNoteAction::class)->name('CreateReleaseNote');
        Route::post('/administrator/settings/releasenote/update', Actions\ReleaseNote\UpdateReleaseNoteAction::class)->name('UpdateReleaseNote');
        Route::post('/administrator/settings/releasenote/delete', Actions\ReleaseNote\DeleteReleaseNoteAction::class)->name('DeleteReleaseNote');

        // ユーザーロールまわり
        Route::post('/administrator/settings/user/role/create', Actions\UserRole\CreateUserRoleAction::class)->name('CreateUserRole');
        Route::post('/administrator/settings/user/role/update', Actions\UserRole\UpdateUserRoleAction::class)->name('UpdateUserRole');
        Route::post('/administrator/settings/user/role/delete', Actions\UserRole\DeleteUserRoleAction::class)->name('DeleteUserRole');

        // ユーザーランクまわり
        Route::post('/administrator/settings/user/rank/create', Actions\UserRank\CreateUserRankAction::class)->name('CreateUserRank');
        Route::post('/administrator/settings/user/rank/update', Actions\UserRank\UpdateUserRankAction::class)->name('UpdateUserRank');
        Route::post('/administrator/settings/user/rank/delete', Actions\UserRank\DeleteUserRankAction::class)->name('DeleteUserRank');
    });
});

Route::post('/login', Actions\Auth\LoginAction::class)->name('spaLogin');
Route::post('/logout', Actions\Auth\LogoutAction::class)->name('spaLogout');
