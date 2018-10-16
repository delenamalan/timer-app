<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return all of the projects that belong to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Auth::user()->projects->keyBy('id');
    }

}
