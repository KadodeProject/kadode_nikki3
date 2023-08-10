<?php

declare(strict_types=1);

use App\Http\ApiActions;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function (): void {
    Route::group(['middleware' => ['web']], function (): void {
        Route::get('/login/{provider}', ApiActions\OAuth\GetProviderOAuthURLAction::class)
            ->name('oAuthRequest');
    });
    Route::get('/auth/{provider}/callback', ApiActions\OAuth\HandleProviderCallbackAction::class)
        ->name('oAuthCallBack');

    Route::get('/status', ApiActions\GetApiStatusAction::class)->name('GetApiStatus');

    // ユーザー、日記、統計の取得API
    Route::get('OperationCoreTransitionPerHours/relative/day', ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestDay::class)->name('GetOperationCoreTransitionLatestDay');
    Route::get('OperationCoreTransitionPerHours/relative/week', ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestWeek::class)->name('GetOperationCoreTransitionLatestWeek');
    Route::get('OperationCoreTransitionPerHours/relative/month', ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestMonth::class)->name('GetOperationCoreTransitionLatestMonth');

    // サーバーのリソース取得API
    Route::get('MachineResource/relative/1min', ApiActions\MachineResource\GetMachineResourceLatest1Minutes::class)->name('GetMachineResourceLatest1Minutes');
    Route::get('MachineResource/relative/30min', ApiActions\MachineResource\GetMachineResourceLatest30Minutes::class)->name('GetMachineResourceLatest30Minutes');
    Route::get('MachineResource/relative/day', ApiActions\MachineResource\GetMachineResourceLatestDay::class)->name('GetMachineResourceLatestDay');
    Route::get('MachineResource/relative/week', ApiActions\MachineResource\GetMachineResourceLatestWeek::class)->name('GetMachineResourceLatestWeek');
    Route::get('MachineResource/relative/month', ApiActions\MachineResource\GetMachineResourceLatestMonth::class)->name('GetMachineResourceLatestMonth');

    // お知らせ一覧取得API
    Route::get('osirase/all', ApiActions\Osirase\GetAllOsiraseAction::class)->name('GetAllOsiraseAction');
    Route::get('osirase/latest', ApiActions\Osirase\GetLatestOsiraseAction::class)->name('GetLatestOsiraseAction');

    // リリースノート一覧取得API
    Route::get('releaseNote/all', ApiActions\ReleaseNote\GetAllReleaseNoteAction::class)->name('GetAllReleaseNoteAction');
    Route::get('releaseNote/latest', ApiActions\ReleaseNote\GetLatestReleaseNoteAction::class)->name('GetLatestReleaseNoteAction');

    Route::group(['middleware' => ['auth:sanctum']], function (): void {
        // 裏側で必要なエンドポイント
        Route::get('/user/init', ApiActions\User\GetUserInfoAction::class)->name('getUserInfo');

        /**
         * Diary
         */
        Route::post('/diary', ApiActions\Diary\CreateDiaryAction::class)->name('CreateDiaryApi');
        Route::get('/diary/{date}', ApiActions\Diary\ReadDiaryAction::class)->where('date', '^\d{4}-\d{2}-\d{2}$')->name('ReadDiaryApi');
        Route::patch('/diary/{date}', ApiActions\Diary\UpdateDiaryAction::class)->where('date', '^\d{4}-\d{2}-\d{2}$')->name('UpdateDiaryApi');
        Route::delete('/diary/{date}', ApiActions\Diary\DeleteDiaryAction::class)->where('date', '^\d{4}-\d{2}-\d{2}$')->name('DeleteDiaryApi');

        /**
         * Diaries
         */

        /*
         * Statistics
         */
        Route::get('/statistic', ApiActions\Statistic\GetStatisticAction::class)->name('GetStatisticsApi');

        // Route::get('/statistic/{year}', ApiActions\StatisticsPerMonth\GetStatisticsPerMonthAction::class)->where('year', '^\d{4}$')->name('GetStatisticsPerYearApi');
        // Route::get('/statistic/{year}/{month}', ApiActions\StatisticsPerMonth\GetStatisticsPerMonthAction::class)->where('year', '^\d{4}$')->where('month', '^\d{2}$')->name('GetStatisticsPerMonthApi');

        /**
         * ページ表示用エンドポイント
         * - 値をまとめて返す系
         * - そのページ独自のform系
         */
        // home
        Route::get('/home', ApiActions\GetHomeAction::class)->name('GetHomeApi');
    });
});
