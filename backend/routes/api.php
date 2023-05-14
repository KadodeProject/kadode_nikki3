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


Route::group(['middleware' => ['web']], function () {
    Route::get('/login/{provider}', ApiActions\OAuth\GetProviderOAuthURLAction::class)
        ->name('oautRequest');
    Route::get('/auth/{provider}/callback', ApiActions\OAuth\HandleProviderCallbackAction::class)
        ->name('oAuthCallBack');
});

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
Route::get('Osirase/all', ApiActions\Osirase\GetAllOsiraseAction::class)->name('GetAllOsiraseAction');
Route::get('Osirase/latest', ApiActions\Osirase\GetLatestOsiraseAction::class)->name('GetLatestOsiraseAction');

// リリースノート一覧取得API
Route::get('ReleaseNote/all', ApiActions\ReleaseNote\GetAllReleaseNoteAction::class)->name('GetAllReleaseNoteAction');
Route::get('ReleaseNote/latest', ApiActions\ReleaseNote\GetLatestReleaseNoteAction::class)->name('GetLatestReleaseNoteAction');

Route::group(['middleware' => ['auth:sanctum']], function (): void {
    Route::get('/user/init', ApiActions\User\GetUserInfoAction::class)->name('getUserInfo');
    Route::get('/home', ApiActions\GetHomeAction::class)->name('GetHomeApi');
    Route::post('/diary/create', ApiActions\Diary\CreateDiaryAction::class)->name('CreateDiaryApi');
});
