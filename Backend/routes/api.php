<?php

use App\Models\Arrangement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PostDutyController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\PostSkillsController;
use App\Http\Controllers\ArrangementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ShortlistController;
use App\Models\Certificate;
use Laravel\Socialite\Facades\Socialite;

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

// Route::middleware('auth:sanctum')->get('user', [LoginController::class, 'User']);

// Route::middleware('auth:sanctum')->post('sign-out', [LoginController::class, 'Logout']);

Route::post('sign-in', [LoginController::class, 'Login'])->middleware('guest');

// Route::get('user', [LoginController::class, 'User']);

Route::resource('sign-up', UserController::class)->only('store')->middleware('guest');

Route::get('auth/redirect', function () {
    Socialite::driver('google')->redirect();
});

Route::get('auth/callback', [AuthController::class, 'google']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [LoginController::class, 'User']);

    Route::resource('vacancies', PostController::class)->except(['create', 'edit']);

    Route::resource('vacancy/duties', PostDutyController::class)->except(['create', 'edit']);

    Route::resource('vacancy/skills', PostSkillsController::class)->except(['create', 'edit']);

    Route::resource('vacancy/requirements', RequirementController::class)->except(['create', 'edit']);

    Route::get('/vacancy/{postId}/applicant/{userId}', [ApplicantController::class, 'show']);

    Route::post('sign-out', [LoginController::class, 'Logout']);

    Route::resource('skills', SkillController::class)->except(['create', 'edit', 'destroy']);

    Route::resource('duties', DutyController::class)->except(['create', 'edit', 'destroy']);

    Route::resource('certificates', CertificateController::class)->except(['create', 'edit', 'destroy']);

    Route::resource('arrangements/', ArrangementController::class)->only(['index']);

    Route::resource('organisation/', OrganisationController::class)->except(['create', 'edit']);

    Route::resource('/jobs', JobController::class)->only(['index']);

    Route::resource('bookmark', BookmarkController::class)->only(['index', 'store', 'destroy', 'show']);

    Route::resource('applicants', ApplicantController::class)->except('create', 'edit', 'destroy');

    Route::put('/vacancy/{postId}/applicant/{userId}', [ApplicantController::class, 'update']);

    Route::resource('shortlist', ShortlistController::class)->except(['create', 'edit']);

    Route::resource('notifications', NotificationController::class)->only(['index', 'update', 'destroy']);

    Route::get('applied/{id}', [ApplicantController::class, 'applied']);

    Route::get('/view/applicant/{id}', [ApplicantController::class, 'viewPdf']);

    Route::resource('resume', ResumeController::class)->except(['create', 'edit']);

    Route::get('download/resume', [PDFController::class, 'resume']);

    Route::get('/vacancy/{postId}/applicant/{userId}/resume', [PDFController::class, 'showResume'])->name('applicant.resume');
});


Route::resource('organisation/', OrganisationController::class)->only(['store']);

// Route::middleware(['guest'])->group(function () {
//     Route::resource('vacancies', PostController::class)->only(['index', 'show']);
// });



// Route::middleware('auth:sanctum')->post('sign-out', [LoginController::class, 'Logout']);

// Route::post('logout', [LoginController::class, 'Logout']);
