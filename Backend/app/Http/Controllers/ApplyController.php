<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Requests\ApplyRequest;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $posts = Apply::where('user_id', $id)->get();
        return response()->json(['posts'=>$posts], 200);
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
    public function store(ApplyRequest $request)
    {
        $file = $request->file('document')->store('Resumes');
        Apply::create([
            'user_id' => request()->user_id,
            'post_id' => request()->post_id,
            'document' => $file,
            'message' => request()->message,
        ]);
        return response()->json("You have applied to a vacancy successfully.", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apply $apply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posts = Apply::where('user_id', $id)->get();
        return response()->json(['posts'=>$posts], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apply $apply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apply $apply)
    {
        //
    }

    public function applied($id)
    {
        $posts = Apply::where('user_id', $id)->get();
        return response()->json(['posts'=>$posts->posts], 200);
    }
}
