<?php

declare(strict_types=1);

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());

Route::get('/', App\Http\ApiActions\GetApiStatus::class)->name('getApiStatus');

// ユーザー、日記、統計の取得API
Route::get('OperationCoreTransitionPerHours/relative/day', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestDay::class)->name('GetOperationCoreTransitionLatestDay');
Route::get('OperationCoreTransitionPerHours/relative/week', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestWeek::class)->name('GetOperationCoreTransitionLatestWeek');
Route::get('OperationCoreTransitionPerHours/relative/month', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestMonth::class)->name('GetOperationCoreTransitionLatestMonth');

// サーバーのリソース取得API
Route::get('MachineResource/relative/30min', \App\Http\ApiActions\MachineResource\GetMachineResourceLatest30Minutes::class)->name('GetMachineResourceLatest30Minutes');
Route::get('MachineResource/relative/month', \App\Http\ApiActions\MachineResource\GetMachineResourceLatestMonth::class)->name('GetMachineResourceLatestMonth');

// お知らせ一覧取得API
Route::get('Osirase/all', \App\Http\ApiActions\Osirase\GetAllOsiraseAction::class)->name('GetAllOsiraseAction');
Route::get('Osirase/latest', \App\Http\ApiActions\Osirase\GetLatestOsiraseAction::class)->name('GetLatestOsiraseAction');

// リリースノート一覧取得API
Route::get('ReleaseNote/all', \App\Http\ApiActions\ReleaseNote\GetAllReleaseNoteAction::class)->name('GetAllReleaseNoteAction');
Route::get('ReleaseNote/latest', \App\Http\ApiActions\ReleaseNote\GetLatestReleaseNoteAction::class)->name('GetLatestReleaseNoteAction');
