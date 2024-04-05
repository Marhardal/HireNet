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
        $posts = Post::get();
            if ($user->organisation_id != '') {
                $posts = Post::where('organisation_id', $user->organisation_id)->get();
                $shortlist = [];
                foreach ($posts as $post => $value) {
                    $totalUsersCount = $value->users()->count();
                    $shortlist[] = [
                        'id' => $value->id,
                        'name' => $value->job->name,
                        'count' => $totalUsersCount,
                    ];
                }
                return response()->json(["shortlisted" => $shortlist], 200);
            } else {
                $post = $user->posts()->get();
                return response()->json(["applicants" => $post], 200);
            }
        // $post = $user->posts()->get();
        // return response()->json(["applicants" => $post], 200);
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
    public function show($id)
    {
        $user = auth()->user();
        $post = Post::find($id);
        if (request()->search) {
            # code...
        } else {
            # code...
        }

        $applicants = $post->users()->wherePivot('shortlisted', 'LIKE', '%' . request()->search . '%');
        return response()->json(["applicants" => $applicants->get(), "count" => $applicants->count()], 200);
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
    public function update(Request $request, $postId,  $userId)
    {
        $post = Post::find($postId);
        $applicant = $post->users()->wherePivot('user_id', $userId)->first()->updatePivot('shortlisted', $request->shortlisted);
        return response()->json('Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
