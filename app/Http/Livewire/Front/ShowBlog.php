<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogCategory;

class ShowBlog extends Component
{
    public $blog;

    public function getCategoriesProperty()
    {
        return BlogCategory::select('id', 'title')->get();
    }

    public function mount($slug)
    {
        $this->blog = Blog::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.front.show-blog')->extends('layouts.guest');
    }
}
