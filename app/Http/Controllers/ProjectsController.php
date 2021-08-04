<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectsController extends Controller
{
    /**
     * ProjectsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        if (auth()->user()->cannot('view', $project)) {
            abort(403);
        }
        return view('projects.show', compact('project'));
    }
}
