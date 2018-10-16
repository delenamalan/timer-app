<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Entry;

class EntriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::info("Logged in user is ");
        Log::info(Auth::user());
        return Auth::user()->entries;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
