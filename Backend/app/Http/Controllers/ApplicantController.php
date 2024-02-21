<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Requests\ApplyRequest;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Applicant::where('post_id', 2)->get();
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
        Applicant::create([
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
    public function show(Applicant $apply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posts = Applicant::where('user_id', $id)->get();
        return response()->json($posts, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $apply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $apply)
    {
        //
    }

    public function applied($id)
    {
        $posts = Applicant::where('user_id', $id)->get();
        return response()->json(['posts'=>$posts], 200);
    }
}
