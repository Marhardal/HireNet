<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->organisation_id == null) {
            if ($user->role->name == "Seeker") {
                $bookmarks = $user->bookmarks->count();
                $vacancies = $user->posts()->count();
                $shortlisted = $user->posts()->wherePivot('shortlisted', 1)->count();
                $declined = $user->posts()->wherePivot('shortlisted', 0)->count();
                $pending = $user->posts()->wherePivot('shortlisted', null)->count();
                $data = [
                    'bookmarks' => $bookmarks,
                    'vacancies' => $vacancies,
                    'shortlisted' => $shortlisted,
                    'declined' => $declined,
                    'pending' => $pending,
                ];
                return response()->json(['dashboard' => $data, 'notifications' => $user->unReadNotifications->take(3)], 200);
            } else {
                $posts = Post::get();
                $data = [
                    'total' => $posts->count(),
                    'completed' => $posts->where('status', 2)->count(),
                    'seeker' => User::where('organisation_id', null)->get()->count(),
                    'recruiter' => User::where('organisation_id', '!=', null)->get()->count(),
                    'users' => User::get()->count(),
                    'hired' => User::where('hired', true)->get()->count(),
                    'organisations' => Organisation::get()->count(),
                    'active' => $posts->where('status', 1)->count(),
                    'pending' => $posts->where('status', 0)->count(),
                ];
                return response()->json(['dashboard' => $data, 'notifications' => $user->unReadNotifications->take(3)], 200);
            }
        } else {
            $posts = Post::where('organisation_id', $user->organisation->id)->get();

            $shortlisted = "";

            $postsCollection = Post::whereIn('id', $posts->pluck('id'))->get(); // Assuming $posts is the collection of posts

            $shortlistedUsers = collect();

            foreach ($postsCollection as $post) {
                $shortlistedUsers = $shortlistedUsers->merge($post->users()->wherePivot('shortlisted', true)->get());
            }

            $uniqueShortlistedUsers = $shortlistedUsers->unique('id');
            $data = [
                'vacancies' => $posts->count(),
                'completed' => $posts->where('status', 2)->count(),
                'active' => $posts->where('status', 1)->count(),
                'applicants' => $posts->where('status', 1)->flatMap(function ($post) {
                    return $post->users;
                })->unique()->count(),
                'shortlisted' => $shortlistedUsers->count(),
            ];
            return response()->json(['dashboard' => $data, 'notifications' => $user->unReadNotifications->take(3)], 200);
        }
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
        //
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
