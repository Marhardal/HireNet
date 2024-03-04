<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $requirement = Requirement::get();
        // return response()->json(['requirements' => $requirement], 200);
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
            'certificate_id' => ['required', Rule::Exists('certificates', 'id')],
        ]);
        $values['post_id']=$request->session()->get('postId');
        Requirement::create($values);

        return response()->json('Vacancy Requirement Created', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Requirement $requirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requirement $requirement)
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
            'certificate_id' => ['required', Rule::Exists('certificates', 'id')],
        ]);

        Requirement::find($id)->update($values);

        return response()->json('Vacancy Requirement Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Requirement::destroy($id);

        return response()->json('Deleted a Vacancy Requirement', 200);
    }
}
