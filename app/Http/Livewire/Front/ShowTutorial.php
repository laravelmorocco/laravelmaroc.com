<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Tutorial;
// use App\Models\TutorialCategory;

class ShowTutorial extends Component
{
    public $tutorial;

    // public function getCategoriesProperty()
    // {
    //     return TutorialCategory::select('id', 'title')->get();
    // }

    public function mount($slug)
    {
        $this->tutorial = Tutorial::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.front.show-tutorial')->extends('layouts.guest');
    }
}
