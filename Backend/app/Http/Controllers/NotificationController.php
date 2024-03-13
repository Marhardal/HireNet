<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\ShortlistDenied;
use App\Notifications\ApplyNotification;
use App\Notifications\ShortlistAccepted;
use App\Notifications\VacancyNotification;
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

    public function applyNotification() {
        $user =  auth()->user();
        // $post = $user->posts()->first();
        $apply = [
            'first' => "We appreciate your interest in Axon. We are happy that you are interested in becoming a member of our team and have received your application for the position of C# Developer (Remote).",
            'second' => "After reviewing your application, we'll let you know if the position is a good fit for your qualifications.",
            'third' => "This email was sent to confirm that you have applied to an opening within our organization.",
            'text' => 'View Vacancy.',
            'url' => url('/')
        ];

        Notification::send($user,new ApplyNotification($apply));

        return response()->json("Apply Notification sent.", 200);
    }

    public function shortlisted(){
        $user = auth()->user();
        $shortlisted = [
            'subject' => "Congratulations! You've Been Shortlisted for [Job Title] Position",
            'salutation' => 'Dear Martin,',
            'body' => 'We are pleased to inform you that you have been shortlisted for the [Job Title] position at [Company Name]. Your exceptional qualifications have impressed us, and we believe your skills align perfectly with our requirements. We invite you for an interview on [Date and Time] at [Office Location/Online Platform]. Please confirm your availability. Congratulations, and we look forward to meeting you.',
            'closing' => 'Best Regards',
            'recruiter' => $user->first_name." ".$user->surname
        ];

        Notification::send($user,new ShortlistAccepted($shortlisted));

        return response()->json("Shortlist Notification sent.", 200);
    }

    public function notShortlisted() {
        $user = auth()->user();
        $denied = [
            'subject'=>'Application Update for [Job Title] Position',
            'salutation'=>'Dear Candidate,',
            'body' => 'Thank you for your application for the [Job Title] position at '.$user->organisation->name.'. After careful review, we regret to inform you that you have not been shortlisted for the next stage. We appreciate your interest and effort, and we encourage you to explore other opportunities. Wishing you success in your job search.',
            'closing' => 'Thank you',
            'recruiter' => $user->first_name." ".$user->surname
        ];

        Notification::send($user,new ShortlistDenied($denied));

        return response()->json("Shortlist Notification sent.", 200);
    }
}
