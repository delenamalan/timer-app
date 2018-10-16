<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Entry;
use App\Project;

class EntriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return all of the time entries belonging to the logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->entries;
    }

    /**
     * Store a newly created time entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'project_id' => 'nullable|exists:projects,id',
            'start' => 'required|date',
            'end' => 'nullable|date|after:start',
        ]);

        Auth::user()->entries()->create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\entries  $entries
     * @return \Illuminate\Http\Response
     */
    public function show(entries $entries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\entries  $entries
     * @return \Illuminate\Http\Response
     */
    public function edit(entries $entries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\entries  $entries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, entries $entries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\entries  $entries
     * @return \Illuminate\Http\Response
     */
    public function destroy(entries $entries)
    {
        //
    }
}
