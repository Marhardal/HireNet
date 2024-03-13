<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Requests\ApplyRequest;
use App\Notifications\VacancyApplied;
use Illuminate\Support\Facades\Storage;
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
        $file = $request->file('document')->store('Resumes');
        Applicant::create([
            'user_id' => request()->user_id,
            'post_id' => request()->post_id,
            'document' => $file,
            'message' => request()->message,
        ]);

        $user = auth()->user();
        $applicant = $user()->posts()->wherePivot('post_id', $request->post_id)->first();

        session()->put('applicant', $applicant);

        $this->applied($applicant);

        return redirect('api/apply/notification');

        return response()->json("You have applied to a vacancy successfully.", 200);
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

    public function Applied($applicant)
    {
        $user = auth()->user();
        $applied = [
            'subject' => 'Application for ' . $applicant->post->job->name . ' - ' . $user->first_name . ' ' . $user->surname,
            'salutation' => 'Dear Recruiter,',
            'body' => "This email is to inform you that " . $user->first_name . " " . $user->surname . " has submitted an application for the " . $applicant->post->job->name . " position that you recently advertised. [He/She/They] are interested in learning more about this opportunity and how [his/her/their] skills and experience can benefit your team.",
            'closing' => 'Thank you'
        ];

        Notification::send($user, new VacancyApplied($applied));

        return response()->json("Vacancy Declined Notification sent.", 200);
    }
}
