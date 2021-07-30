<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function store()
    {
        \App\Models\Project::create(['title' => request('title'), 'description' => request('description')]);
        return redirect('/projects');
    }

    public function index()
    {
        $projects = \App\Models\Project::all();
        return view('projects.index', compact('projects'));
    }
}
