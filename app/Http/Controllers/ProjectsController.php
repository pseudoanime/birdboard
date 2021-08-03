<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * ProjectsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function store()
    {
        $attributes = \request()->validate(
            ['title' => 'required', 'description' => 'required']
        );

        auth()->user()->projects()->create($attributes);
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
