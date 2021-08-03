<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function store()
    {
        $attributes = \request()->validate(['title' => 'required', 'description' => 'required']);
        \App\Models\Project::create($attributes);
        return redirect('/projects');
    }

    public function index()
    {
        $projects = \App\Models\Project::all();
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
}
