<?php

namespace App\Http\Controllers;

use App\Models\Duty;
use Illuminate\Http\Request;

class DutyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $duty = Duty::get();
        return response()->json($duty, 200);
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
    public function show(Duty $duty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Duty $duty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Duty $duty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Duty $duty)
    {
        //
    }
}
