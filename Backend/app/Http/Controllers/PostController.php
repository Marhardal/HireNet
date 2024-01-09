<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $post = Post::latest()->Filters(request(['search']));
        return response()->json($post->get());
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
        Post::create($request->all());
        return response()->json('Vacancy Created Successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $post = Post::find($id);
        $posts = Post::latest()->take(6)->get();
        return response()->json(['post' => $post, 'posts' => $posts]);
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
