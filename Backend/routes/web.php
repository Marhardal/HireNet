<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apply/notification', [NotificationController::class, 'applyNotification']);

Route::get('/shortlist/accepted/notification', [NotificationController::class, 'shortlisted']);

Route::get('/shortlist/denied/notification', [NotificationController::class, 'notShortlisted']);

Route::get('vacancy/status/notification', [NotificationController::class, 'vacancyStatus']);

Route::get('vacancy/approved/notification', [NotificationController::class, 'vacancyApproved']);

Route::get('vacancy/denied/notification', [NotificationController::class, 'vacancyDenied']);

Route::get('vacancy/created/notification', [NotificationController::class, 'vacancyCreated']);

Route::get('vacancy/applied/notification', [NotificationController::class, 'Applied']);

Route::get('/send', [NotificationController::class, 'sendVacancy']);
