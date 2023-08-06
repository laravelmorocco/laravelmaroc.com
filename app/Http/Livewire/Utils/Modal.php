<?php

declare(strict_types=1);

namespace App\Http\Livewire\Utils;

use Livewire\Component;

final class Modal extends Component
{
    public $show = false;

    protected $listeners = [
        'show' => 'show',
    ];

    /**
     * -------------------------------------------------------------------------------
     *  Set Modal
     * -------------------------------------------------------------------------------
     */
    public function show(): void
    {
        $this->show = true;
    }
}
