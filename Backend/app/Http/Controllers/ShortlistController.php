<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ShortlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $posts = Post::where('organisation_id', $user->organisation_id)->get();
        $shortlist = [];
        foreach ($posts as $post => $value) {
            $totalUsersCount = $value->users()->wherePivot('post_id', $value->id)->wherePivot('shortlisted', true);
            $shortlist[] = [
                'id'=> $value->id,
                'name' => $value->job->name,
                'count' => $totalUsersCount->count(),
            ];
        }
        return response()->json(["shortlisted" => $shortlist], 200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        $post = Post::find($id)->where('organisation_id', $user->organisation_id)->first();
        $applicants = $post->users()->wherePivot('shortlisted', true);
        return response()->json(["applicants" => $applicants->get()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
