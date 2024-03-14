<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Requests\ApplyRequest;
use App\Notifications\VacancyApplied;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ApplyNotification;
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
        // $file = $request->file('document')->store('Resumes');
        Applicant::create([
            'user_id' => auth()->user()->id,
            'post_id' => request()->post_id,
            'document' => request()->document,
            'message' => request()->message,
        ]);

        $user = auth()->user();

        $post = Post::find(request()->post_id);

        $applicant = $post->users()->wherePivot('user_id', auth()->user()->id)->first();

        session()->put(['post' => $post]);

        $this->applied($post);

        $this->applyNotification($post);

        return response()->json($post, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($postId, $userId)
    {
        $applicant = User::find($userId);
        $post = $applicant->posts()->wherePivot('post_id', $postId)->first();
        return response()->json(['post' => $post, 'applicant' => $applicant, 'attach' => $post->pivot], 200);
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
    public function update(Request $request, Applicant $apply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $apply)
    {
        //
    }

    // public function applied($id)
    // {
    //     $posts = Applicant::where('user_id', $id)->get();
    //     return response()->json(['posts' => $posts], 200);
    // }

    public function Applied($post)
    {
        $user = auth()->user();
        $applied = [
            'subject' => 'Application for ' . $post->job->name . ' - ' . $user->first_name . ' ' . $user->surname,
            'salutation' => 'Dear Recruiter,',
            'body' => "This email is to inform you that " . $user->first_name . " " . $user->surname . " has submitted an application for the " . $post->job->name . " position that you recently advertised. [He/She/They] are interested in learning more about this opportunity and how [his/her/their] skills and experience can benefit your team.",
            'closing' => 'Thank you'
        ];

        Notification::send($user, new VacancyApplied($applied));

        return response()->json("Vacancy Declined Notification sent.", 200);
    }

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

        Notification::send($user, new ApplyNotification($apply));

        return response()->json("Apply Notification sent.", 200);
    }
}
