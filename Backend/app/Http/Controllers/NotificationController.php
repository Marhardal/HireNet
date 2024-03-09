<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\VacancyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function sendVacancy() {
        $user = User::first();
        $vacancy = [
            'body' => 'New Vacancy Alert',
            'text' => 'There is an opening at a certain organization.',
            'url' => url('/')
        ];

        // $user->notify(new VacancyNotification($vacancy));

        Notification::sendNow($user, new VacancyNotification($vacancy));

        return response()->json('Notification Sent');
    }
}
