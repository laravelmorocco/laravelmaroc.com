<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permission.index');
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function show(Permission $permission)
    {
        return view('admin.permission.show', compact('permission'));
    }
}
