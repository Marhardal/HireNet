<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        $bookmark = Bookmark::create($request->all());
        return response()->json("Vacancy Bookmarked Successfully", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bookmark = Bookmark::where('user_id', '=' , $id)->get();
        $posts = $bookmark->map(function ($bookmark){
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
