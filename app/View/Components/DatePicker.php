<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

final class DatePicker extends Component
{
    /** Create a new component instance. */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.date-picker');
    }
}
