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

Route::get('OperationCoreTransitionPerHours/relative/day', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestDay::class)->name('GetOperationCoreTransitionLatestDay');
Route::get('OperationCoreTransitionPerHours/relative/week', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestWeek::class)->name('GetOperationCoreTransitionLatestWeek');
Route::get('OperationCoreTransitionPerHours/relative/month', \App\Http\ApiActions\OperationCoreTransition\GetOperationCoreTransitionLatestMonth::class)->name('GetOperationCoreTransitionLatestMonth');
