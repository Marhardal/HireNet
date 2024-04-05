<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return response()->json(['post' => $user->bookmarks], 200);
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
        if (!auth()->user()->bookmarks->where('post_id', $request->id)->first()) {
            $bookmark = Bookmark::create([
                'post_id' => $request->id,
                'user_id' => Auth::user()->id
            ]);
            return response()->json("Vacancy Bookmarked Successfully", 200);
        }else {
            return response()->json("Vacancy Not Bookmarked", 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bookmark = Bookmark::where('user_id', '=', $id)->get();
        $posts = $bookmark->map(function ($bookmark) {
            return $bookmark->post;
        });
        return response()->json($posts, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Bookmark::destroy($id);
        return response()->json('BookMarked Vacancy Deleted Successfully', 200);
    }
}
