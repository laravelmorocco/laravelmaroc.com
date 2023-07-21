<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.auth.index')->extends('layouts.guest');
    }
}
