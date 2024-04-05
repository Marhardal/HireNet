<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Requests\ApplyRequest;
use App\Notifications\VacancyApplied;
use App\Notifications\ShortlistDenied;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ApplyNotification;
use App\Notifications\ShortlistAccepted;
use Illuminate\Support\Facades\Notification;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Applicant::where('post_id', 2)->get();

        return response()->json(['posts' => $posts], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplyRequest $request)
    {
        $user = Applicant::where('post_id', $request->post_id)->where('user_id', auth()->user()->id)->get()->first();
        if (!$user) {
            $file = $request->file('document')->store('Resumes');
            Applicant::create([
                'user_id' => auth()->user()->id,
                'post_id' => $request->post_id,
                'document' => $file,
                'message' => $request->message,
            ]);

            $user = auth()->user();

            $post = Post::find(request()->post_id);

            $recruiters = User::where('organisation_id', $post->organisation->id)->get();
            $this->applied($post, $recruiters);

            $this->applyNotification($post);

            return response()->json('Notifications Sent', 200);
        } else {
            return response()->json('You have already Applied!', 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($postId, $userId)
    {
        $post = Post::find($postId);
        $applicant = $post->users()->wherePivot('user_id', $userId)->get();
        $path = storage_path($applicant->first()->pivot->document);
        $url = route('applicant.resume', ['userId' => $userId, 'postId' => $postId]);
        return response()->json(['applicant' => $applicant->first(), 'post' => $post, 'url' => $url], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posts = Applicant::where('user_id', $id)->get();
        return response()->json($posts, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $postId,  $userId)
    {
        $post = Post::find($postId);
        $applicant = $post->users()->wherePivot('user_id', $userId)->get()->first();
        $applicant->pivot->update(['shortlisted' => $request->shortlisted]);
        if ($applicant->pivot->shortlisted == true) {
            $this->ShortlistedNotification($post, $applicant);
        } else if ($applicant->pivot->shortlisted == false) {
            $this->notShortlistedNotification($post, $applicant);
        }
        return response()->json($applicant, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $apply)
    {
        //
    }

    public function applied($id)
    {
        $posts = Applicant::where('user_id', $id)->get();
        return response()->json(['posts' => $posts], 200);
    }

    // public function Applied($post)
    // {
    //     $user = auth()->user();
    //     // $recruiters = User::where('organisation_id', $post->organisation_id)->get();
    //     $recruiters = $post->organisation->users;
    //     $applied = [
    //         'subject' => 'Application for ' . $post->job->name . ' - ' . $user->first_name . ' ' . $user->surname,
    //         'salutation' => 'Dear ' . $post->organisation->name,
    //         'body' => "This email is to inform you that " . $user->first_name . " " . $user->surname . " has submitted an application for the " . $post->job->name . " position that your organisation recently advertised. " . $user->first_name . " is interested in learning more about this opportunity and how " . $user->first_name . "'s skills and experience can benefit your team.",
    //         'closing' => 'Thank you'
    //     ];

    //     Notification::send($recruiters, new VacancyApplied($applied, $post));

    //     return response()->json("Vacancy Declined Notification sent.", 200);
    // }

    public function applyNotification($post)
    {
        $user =  auth()->user();
        $apply = [
            'subject' => "Your application for " . $post->job->name . " at " . $post->organisation->name . " is submitted!",
            'salutation' => "Dear " . $user->first_name,
            'body' => "Your application for the " . $post->job->name . " position at " . $post->organisation->name . " has been successfully submitted. We look forward to reviewing your qualifications and will be in touch with you regarding next steps.",
            'text' => 'View Vacancy.',
            'url' => url('/')
        ];

        Notification::send($user, new ApplyNotification($apply, $post));

        return response()->json("Apply Notification sent.", 200);
    }

    public function ShortlistedNotification($post, $user)
    {
        $shortlisted = [
            'subject' => "Congratulations! You've Been Shortlisted for " . $post->job->name . " Position",
            'salutation' => 'Dear ' . $user->first_name . ',',
            'body' => 'We are pleased to inform you that you have been shortlisted for the ' . $post->job->name . ' position at ' . $post->organisation->name . '. Your exceptional qualifications have impressed us, and we believe your skills align perfectly with our requirements. Please wait while our HR department is setting for a date where we can conduct the interview.',
            'closing' => 'Best Regards',
            'recruiter' => $post->organisation->name
        ];

        Notification::send($user, new ShortlistAccepted($shortlisted, $post));

        return response()->json($post, 200);
    }

    public function notShortlistedNotification($post, $user)
    {
        $denied = [
            'subject' => 'Application Update for ' . $post->job->name . ' Position',
            'salutation' => 'Dear ' . $user->first_name . ',',
            'body' => 'Thank you for your application for the ' . $post->job->name . ' position at ' . $post->organisation->name . '. After careful review, we regret to inform you that you have not been shortlisted for the next stage. We appreciate your interest and effort, and we encourage you to explore other opportunities. Wishing you success in your job search.',
            'closing' => 'Thank you',
            'recruiter' => $post->organisation->name
        ];

        Notification::send($user, new ShortlistDenied($denied, $post));

        return response()->json("Shortlist Notification sent.", 200);
    }
}
