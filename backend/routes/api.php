<?php

declare(strict_types=1);

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

Route::get('/status', App\Http\ApiActions\GetApiStatusAction::class)->name('GetApiStatusAction');

// ユーザー、日記、統計の取得API
Route::get('OperationCoreTransitionPerHours/relative/day', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestDay::class)->name('GetOperationCoreTransitionLatestDay');
Route::get('OperationCoreTransitionPerHours/relative/week', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestWeek::class)->name('GetOperationCoreTransitionLatestWeek');
Route::get('OperationCoreTransitionPerHours/relative/month', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestMonth::class)->name('GetOperationCoreTransitionLatestMonth');

// サーバーのリソース取得API
Route::get('MachineResource/relative/1min', \App\Http\ApiActions\MachineResource\GetMachineResourceLatest1Minutes::class)->name('GetMachineResourceLatest1Minutes');
Route::get('MachineResource/relative/30min', \App\Http\ApiActions\MachineResource\GetMachineResourceLatest30Minutes::class)->name('GetMachineResourceLatest30Minutes');
Route::get('MachineResource/relative/day', \App\Http\ApiActions\MachineResource\GetMachineResourceLatestDay::class)->name('GetMachineResourceLatestDay');
Route::get('MachineResource/relative/week', \App\Http\ApiActions\MachineResource\GetMachineResourceLatestWeek::class)->name('GetMachineResourceLatestWeek');
Route::get('MachineResource/relative/month', \App\Http\ApiActions\MachineResource\GetMachineResourceLatestMonth::class)->name('GetMachineResourceLatestMonth');

// お知らせ一覧取得API
Route::get('Osirase/all', \App\Http\ApiActions\Osirase\GetAllOsiraseAction::class)->name('GetAllOsiraseAction');
Route::get('Osirase/latest', \App\Http\ApiActions\Osirase\GetLatestOsiraseAction::class)->name('GetLatestOsiraseAction');

// リリースノート一覧取得API
Route::get('ReleaseNote/all', \App\Http\ApiActions\ReleaseNote\GetAllReleaseNoteAction::class)->name('GetAllReleaseNoteAction');
Route::get('ReleaseNote/latest', \App\Http\ApiActions\ReleaseNote\GetLatestReleaseNoteAction::class)->name('GetLatestReleaseNoteAction');

Route::group(['middleware' => ['auth:sanctum']], function (): void {
    Route::get('/user/init', \App\Http\ApiActions\User\GetUserInfoAction::class)->name('getUserInfo');
    Route::get('/test', \App\Http\ApiActions\GetHomeAction::class)->name('getHome');
    Route::post('/diary/create', \App\Http\ApiActions\Diary\CreateDiaryAction::class)->name('CreateDiaryApi');
});
