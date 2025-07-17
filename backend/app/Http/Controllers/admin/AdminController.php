<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

class AdminController extends Controller
{
    //
    public function index()
    {
        $totalProjects = Project::count();
        $activeProjects = Project::where('active', true)->count();
        return view('admin.index', compact('totalProjects', 'activeProjects'));
    }

    public function portfolio()
    {
        $totalProjects = Project::count();
        $activeProjects = Project::where('active', true)->count();
        return view('admin.portfolio', compact('totalProjects', 'activeProjects'));
    }
}
