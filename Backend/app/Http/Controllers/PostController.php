<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostDuty;
use App\Models\Applicant;
use App\Models\PostSkills;
use App\Models\Requirement;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

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
            $post = $posts->where('status', false)->get();
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
            'status' => false,
            'num'=>$request->num,
            'about' => $request->about,
            'due_date' => $request->due_date
        ]);

        $post->duty()->attach($request->duty_id);

        $post->skills()->attach($request->skill_id);

        $post->certificate()->attach($request->certificate_id);

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
        Post::find($id)->update($request->all());
        return response()->json("Vacancy Updated Successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json('Vacancy Deleted', 200);
    }
}
