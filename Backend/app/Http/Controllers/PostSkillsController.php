<?php

namespace App\Http\Controllers;

use App\Models\PostSkills;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostSkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $values = $request->validate([
            'skill_id' => ['required', Rule::Exists('skills', 'id')],
        ]);
        $values['post_id'] = $request->session()->get('postId');
        PostSkills::create($values);
        return response()->json('Post Skills Created', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PostSkills $postSkills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostSkills $postSkills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $values = $request->validate([
            'post_id'=>['required', Rule::exists('posts', 'id')],
            'skill_id'=>['required', Rule::exists('skills', 'id')],
        ]);

        PostSkills::find($id)->update($values);

        return response()->json('Post Skills Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PostSkills::find($id)->delete();

        return response()->json('Post Skill Deleted', 200);
    }
}
