<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\ShortlistDenied;
use App\Notifications\ApplyNotification;
use App\Notifications\ShortlistAccepted;
use App\Notifications\VacancyApplied;
use App\Notifications\VacancyApproval;
use App\Notifications\VacancyCreated;
use App\Notifications\VacancyDeclined;
use App\Notifications\VacancyNotification;
use Illuminate\Support\Facades\Notification;

use function Clue\StreamFilter\fun;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        $notifies = $notifications->map(function ($notification) {
            return [
                'data' => $notification->data,
                'created_at' => $notification->created_at,
                'read_at' => $notification->read_at,
                'id' => $notification->id
            ];
        });
        return response()->json($notifies, 200);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        if ($id == 1) {
            $user->unreadNotifications->markAsRead();
            return response()->json($user, 200);
        }else {
            $unread = $user->notifications->find($id)->first();
            $unread->markAsRead();
            return response()->json($unread, 200);
        }
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $user->notifications()->delete();
        return response()->json($user, 200);
    }

    // public function sendVacancy()
    // {
    //     $user = User::first();
    //     $vacancy = [
    //         'body' => 'New Vacancy Alert',
    //         'text' => 'There is an opening at a certain organization.',
    //         'url' => url('/')
    //     ];

    //     // $user->notify(new VacancyNotification($vacancy));

    //     Notification::sendNow($user, new VacancyNotification($vacancy));

    //     return response()->json('Notification Sent');
    // }

    // public function applyNotification()
    // {
    //     $user =  auth()->user();
    //     $post = session()->get('post');
    //     $apply = [
    //         'subject' => "Your application for " . $post->job->name . " at " . $post->organisation->name . " is submitted!",
    //         'salutation' => "Dear " . $user->first_name,
    //         'body' => "Your application for the " . $post->job->name . " position at " . $post->organisation->name . " has been successfully submitted. We look forward to reviewing your qualifications and will be in touch with you regarding next steps.",
    //         'text' => 'View Vacancy.',
    //         'url' => url('/')
    //     ];

    //     Notification::send($user, new ApplyNotification($apply, $post));

    //     return response()->json("Apply Notification sent.", 200);
    // }

    // public function shortlisted()
    // {
    //     $user = auth()->user();
    //     $shortlisted = [
    //         'subject' => "Congratulations! You've Been Shortlisted for [Job Title] Position",
    //         'salutation' => 'Dear Martin,',
    //         'body' => 'We are pleased to inform you that you have been shortlisted for the [Job Title] position at [Company Name]. Your exceptional qualifications have impressed us, and we believe your skills align perfectly with our requirements. We invite you for an interview on [Date and Time] at [Office Location/Online Platform]. Please confirm your availability. Congratulations, and we look forward to meeting you.',
    //         'closing' => 'Best Regards',
    //         'recruiter' => $user->first_name . " " . $user->surname
    //     ];

    //     Notification::send($user, new ShortlistAccepted($shortlisted));

    //     return response()->json("Shortlist Notification sent.", 200);
    // }

    // public function notShortlisted()
    // {
    //     $user = auth()->user();
    //     $denied = [
    //         'subject' => 'Application Update for [Job Title] Position',
    //         'salutation' => 'Dear Candidate,',
    //         'body' => 'Thank you for your application for the [Job Title] position at [Organization Name]. After careful review, we regret to inform you that you have not been shortlisted for the next stage. We appreciate your interest and effort, and we encourage you to explore other opportunities. Wishing you success in your job search.',
    //         'closing' => 'Thank you',
    //         'recruiter' => $user->first_name . " " . $user->surname
    //     ];

    //     Notification::send($user, new ShortlistDenied($denied));

    //     return response()->json("Shortlist Notification sent.", 200);
    // }

    // public function vacancyCreated()
    // {
    //     $user = auth()->user();
    //     $created = [
    //         'subject' => 'New Vacancy Created: [Job Title]',
    //         'salutation' => 'Dear Admin,',
    //         'body' => 'A new vacancy for the [Job Title] position has been created by the ' . $user->organisation->name . ' team.  Your review and any necessary next steps, such as budget approval, may be required.',
    //         'closing' => 'Thank you'
    //     ];

    //     Notification::send($user, new VacancyCreated($created));

    //     return response()->json("Vacancy Created Notification sent.", 200);
    // }

    // public function vacancyApproved()
    // {
    //     $user = auth()->user();

    //     $post = session()->get('post');

    //     $denied = [
    //         'subject' => 'Great news! Your vacancy for ' . $post->job->name . ' has been approved.',
    //         'salutation' => 'Dear Recruiter,',
    //         'body' => "I'm happy to inform you that your requisition for the " . $post->job->name . " position has been approved! You can now move forward with advertising the vacancy and start receiving applications from qualified candidates.",
    //         'closing' => 'Thank you'
    //     ];

    //     Notification::send($user, new VacancyApproval($denied));

    //     session()->forget('post');

    //     return response()->json("Vacancy Approval Notification sent.", 200);
    // }

    // public function vacancyDenied()
    // {
    //     $user = auth()->user();

    //     $post = session()->get('post');

    //     $denied = [
    //         'subject' => 'Update on ' . $post->job->name . ' vacancy requisition',
    //         'salutation' => 'Dear Recruiter,',
    //         'body' => "This email is to inform you that your requisition for the " . $post->job->name . " position has been Declined at this time. We'll be in touch if the hiring manager decides to reopen the position in the future.",
    //         'closing' => 'Thank you',
    //         'recruiter' => $user->first_name . " " . $user->surname
    //     ];

    //     Notification::send($user, new VacancyDeclined($denied));

    //     session()->forget('post');

    //     return response()->json("Shortlist Notification sent.", 200);
    // }

    // public function Applied()
    // {
    //     $user = auth()->user();
    //     $applicant = session()->get('applicant');
    //     $applied = [
    //         'subject' => 'Application for ' . $applicant->post->job->name . ' - ' . $user->first_name . ' ' . $user->surname,
    //         'salutation' => 'Dear Recruiter,',
    //         'body' => "This email is to inform you that " . $user->first_name . " " . $user->surname . " has submitted an application for the " . $applicant->post->job->name . " position that you recently advertised. [He/She/They] are interested in learning more about this opportunity and how [his/her/their] skills and experience can benefit your team.",
    //         'closing' => 'Thank you'
    //     ];

    //     Notification::send($user, new VacancyApplied($applied));

    //     return response()->json("Vacancy Declined Notification sent.", 200);
    // }

    // public function VacancyStatus()
    // {
    //     $user = auth()->user();

    //     $post = session()->get('post');

    //     $applied = [
    //         'subject' => 'Action Required: ' . $post . ' Vacancy Awaiting Admin Approval',
    //         'salutation' => 'Dear Recruiter,',
    //         'body' => "You've successfully created the vacancy for the " . $post . " position! The requisition has been sent to the admin team for review and budget approval. We'll notify you once it's finalized.",
    //         'closing' => 'Thank you'
    //     ];

    //     Notification::send($user, new VacancyApplied($applied));

    //     session()->forget('post');

    //     session()->forget('user');

    //     return response()->json("Vacancy Created Notification sent.", 200);
    // }
}
