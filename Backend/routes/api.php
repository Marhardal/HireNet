<?php

use App\Http\Controllers\ArrangementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDutyController;
use App\Http\Controllers\PostSkillsController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Models\Arrangement;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('vacancies', PostController::class)->except(['create', 'edit']);

Route::resource('users', UserController::class)->except('create', 'edit');

Route::resource('vacancy/skills', PostSkillsController::class)->only('store', 'update', 'destroy');

Route::resource('vacancy/duties', PostDutyController::class)->only('store', 'update', 'destroy');

Route::resource('vacancy/requirements', RequirementController::class)->only('store', 'update', 'destroy');

Route::resource('arrangements/', ArrangementController::class)->only(['index']);
