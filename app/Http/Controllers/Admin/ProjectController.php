<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    // Index Project
    public function index()
    {
        return view('admin.project.index');
    }

    // Add Project
    public function create(Project $project)
    {
        return view('admin.project.create', compact('project'));
    }

    // Project  Edit
    public function edit(Project $project)
    {
        return view('admin.project.edit', compact('project'));
    }

    // Project  Show
    public function show(Project $project)
    {
        return view('admin.project.show', compact('project'));
    }
}
