<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organisation = Organisation::all();
        return response()->json($organisation);
    }

    public function Vacancies()
    {
        // $posts = Post::where('organisation_id', auth()->user()->organisation_id)->get();

        return response()->json(auth()->check(), 200);
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
            'name' => ['required'],
            'location' => ['required'],
            'about' => ['required'],
        ]);

        $organisation = Organisation::create($values);

        // session(['organisation_id' => $organisation->id]);

        return response()->json(["Organisation Created Successfully", 'organisation' => $organisation], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($id, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisation $organisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisation $organisation)
    {
        $organisation->update($request->all());
        return response()->json($organisation, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation)
    {
        //
    }
}
