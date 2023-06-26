<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamController extends Controller
{
    // Index Team
    public function index()
    {
        return view('admin.team.index');
    }

    // Add Team
    public function create()
    {
        return view('admin.team.create');
    }

    // Team Edit
    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    // Team  Show
    public function show(Team $team)
    {
        return view('admin.team.show', compact('team'));
    }
}
