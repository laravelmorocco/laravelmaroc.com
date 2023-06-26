<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    // Index Service
    public function index()
    {
        return view('admin.service.index');
    }

    // Add Service
    public function create()
    {
        return view('admin.service.create');
    }

    // Service Edit
    public function edit(Service $service)
    {
        return view('admin.service.edit', compact('service'));
    }
}
