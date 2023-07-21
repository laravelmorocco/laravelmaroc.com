<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Project;
use App\Models\Service;
use App\Models\Section;
use App\Models\Partner;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Enums\PageType;

class Index extends Component
{
    public function getHomeSectionProperty()
    {
        return Section::where('type', PageType::HOME)->active()->first();
    }

    public function getPartnersProperty(): Collection
    {
        return Partner::active()->get();
    }

    public function getAboutSectionProperty()
    {
        return Section::where('type', PageType::ABOUT)->active()->first();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.index')->extends('layouts.guest');
    }
}
