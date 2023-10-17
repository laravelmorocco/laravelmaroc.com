<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

final class Select2 extends Component
{
    public $name;
    public $id;
    public $options;
    public $selected;
    public $multiple;
    public $searchable;

    public function __construct($name, $id, $options, $selected = null, $multiple = false, $searchable = false)
    {
        $this->name = $name;
        $this->id = $id;
        $this->options = $options;
        $this->selected = $selected;
        $this->multiple = $multiple;
        $this->searchable = $searchable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.select2');
    }
}
