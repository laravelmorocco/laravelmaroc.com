<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Tutorial;
use App\Models\Category;
use Livewire\WithPagination;

class Tutorials extends Component
{

    use WithPagination;

    public $category;

    protected $listeners = ['categorySelected'];

    public function categorySelected($category)
    {
        $this->category = $category;
    }

    public function getCategoriesProperty()
    {
        return Category::select('id', 'title')->get();
    }
   
    public function render()
    {
        $tutorials = Tutorial::with('category')
            ->when('category', function ($query) {
                $query->where('category_id', $this->category);
            })->paginate(6);

        return view('livewire.front.tutorials', compact('tutorials'))->extends('layouts.guest');
    }
}
