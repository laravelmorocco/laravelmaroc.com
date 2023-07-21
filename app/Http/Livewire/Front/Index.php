<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Project;
use App\Models\Section;
use App\Models\Blog;
use App\Models\Developer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Enums\PageType;

class Index extends Component
{
    public function getHomeSectionProperty()
    {
        return Section::where('type', PageType::HOME)->active()->firstOrFail();
    }

    public function getBlogsProperty()
    {
        return Blog::query()->active()->latest()->take(6)->get();
    }

    public function getDevelopersProperty(): Collection
    {
        return Developer::active()->get();
    }

    public function getAboutSectionProperty()
    {
        return Section::where('type', PageType::ABOUT)->active()->firstOrFail();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.index')->extends('layouts.guest');
    }
}
