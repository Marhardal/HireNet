<?php

namespace App\Http\Controllers;

use App\Models\PostDuty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostDutyController extends Controller
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
            'post_id' => ['required', Rule::Exists('posts', 'id')],
            'duty_id' => ['required', Rule::Exists('duties', 'id')],
        ]);

        PostDuty::create($values);

        return response()->json('Post Duty Added', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PostDuty $postDuty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostDuty $postDuty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $values = $request->validate([
            'post_id' => ['required', Rule::Exists('posts', 'id')],
            'duty_id' => ['required', Rule::Exists('duties', 'id')],
        ]);

        PostDuty::find($id)->update($values);

        return response()->json('Post Duty Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PostDuty::find($id)->delete();

        return response()->json('Post Duty Delete', 200);
    }
}
