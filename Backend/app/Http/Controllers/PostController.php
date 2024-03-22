<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use App\Models\PostDuty;
use App\Models\Applicant;
use App\Models\PostSkills;
use App\Models\Requirement;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\User;
use App\Notifications\VacancyApplied;
use App\Notifications\VacancyCreated;
use App\Notifications\VacancyApproval;
use App\Notifications\VacancyDeclined;
use App\Notifications\VacancyNotification;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::Filters(request(['search']));
        $post = "";
        $user = auth()->user();
        if (auth()->guest() || $user->role->name == "Seeker") {
            $post = $posts->where('status', true)->get();
        } elseif ($user->role->name == "Recruiter") {
            $post = $posts->where('organisation_id', $user->organisation_id)->get();
        } else {
            $post = $posts->where('status', null)->get();
        }
        return response()->json($post);
    }

    public function Vacancies()
    {
        $posts = Post::where('organisation_id', auth()->user()->organisation_id)->get();
        return response()->json($posts, 200);
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
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'organisation_id' => auth()->user()->organisation->id,
            'job_id' => $request->job_id,
            'arrangement_id' => $request->arrangement_id,
            'num' => $request->num,
            'about' => $request->about,
            'due_date' => $request->due_date
        ]);

        $post->duty()->attach($request->duty_id);

        $post->skills()->attach($request->skill_id);

        $post->certificate()->attach($request->certificate_id);

        $this->vacancyCreated(auth()->user(), $post);

        // $this->vacancyApproved();

        $job = Job::find($request->job_id);

        session()->put(['post' => $job->name, 'user' => auth()->user]);

        return response()->json('Vacancy Created Successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['post' => $post, 'applicants' => $post->users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update([
            'status' => $request->status,
        ]);
        session()->put('post', $post);
        $user = User::where('organisation_id', $post->organisation_id)->get();
        // $user = auth()->user();
        if ($post->status == 1) {
            $this->sendVacancy($post);
            $this->vacancyApproved($user, $post);
        } else if ($post->status == 0) {
            $this->vacancyDenied($user, $post);
        }
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json('Vacancy Deleted', 200);
    }

    public function vacancyCreated($user, $vacancy)
    {
        $user = User::where('role_id', 3)->get();
        $created = [
            'subject' => 'New Vacancy Created: ' . $vacancy->job->name,
            'salutation' => 'Dear Admin,',
            'body' => 'A new vacancy for the ' . $vacancy->job->name . ' position has been created by the ' . $user->organisation->name . ' team.  Your review and any necessary next steps, such as budget approval, may be required.',
            'closing' => 'Thank you'
        ];

        Notification::send($user, new VacancyCreated($created));

        return response()->json("Vacancy Created Notification sent.", 200);
    }

    public function sendVacancy($post)
    {
        $user = User::where('role_id', 2)->get();
        $vacancy = [
            'subject' => 'Exciting opportunity! New ' . $post->job->name . ' position available',
            'body' => "We're thrilled to announce a new opening for a " . $post->job->name . "! This could be a great fit for someone with your skills and experience. Check out the full details and apply on the link below.",
            'text' => "View Job,",
            'url' => url('/')
        ];

        Notification::send($user, new VacancyNotification($vacancy, $user, $post));

        return response()->json('Notification Sent');
    }

    public function vacancyApproved($user, $post)
    {

        $approved = [
            'subject' => 'Great news! Your vacancy for ' . $post->job->name . ' has been approved.',
            'salutation' => 'Dear Recruiter,',
            'body' => "I'm happy to inform you that your requisition for the " . $post->job->name . " position has been approved! You can now move forward with advertising the vacancy and start receiving applications from qualified candidates.",
            'closing' => 'Thank you'
        ];

        Notification::send($user, new VacancyApproval($approved, $user, $post));

        session()->forget('post');

        return response()->json("Vacancy Approval Notification sent.", 200);
    }

    public function vacancyDenied($user, $post)
    {
        $denied = [
            'subject' => 'Update on ' . $post->job->name . ' vacancy requisition',
            'salutation' => 'Dear Recruiter,',
            'body' => "This email is to inform you that your requisition for the " . $post->job->name . " position has been Declined at this time. We'll be in touch if the hiring manager decides to reopen the position in the future.",
            'closing' => 'Thank you'
        ];

        Notification::send($user, new VacancyDeclined($denied, $post));

        return response()->json("Shortlist Notification sent.", 200);
    }
}
