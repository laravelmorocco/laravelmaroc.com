<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;

class TutorialController extends Controller
{
    // Index Tutorial
    public function index()
    {
        return view('admin.tutorial.index');
    }

    // Add Tutorial
    public function create(Tutorial $tutorial)
    {
        return view('admin.tutorial.create', compact('tutorial'));
    }

    // Tutorial  Edit
    public function edit(Tutorial $tutorial)
    {
        return view('admin.tutorial.edit', compact('tutorial'));
    }

    // Tutorial  Show
    public function show(Tutorial $tutorial)
    {
        return view('admin.tutorial.show', compact('tutorial'));
    }
}
