<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class WelcomeController extends Controller
{
    public function index()
    {
        $Projects = Project::all();
        return view('welcome', compact('Projects'));
    }
}
