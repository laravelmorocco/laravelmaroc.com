<?php

declare(strict_types=1);

namespace App\Http\Livewire\Utils;

use Livewire\Component;

final class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.utils.sidebar');
    }
}
