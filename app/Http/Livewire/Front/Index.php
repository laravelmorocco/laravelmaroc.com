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

    public function getStartupServicesProperty(): Collection
    {
        return Service::where('type', 'startup')->active()->get();
    }

    public function getDigitalServicesProperty(): Collection
    {
        return Service::where('type', 'digital')->active()->get();
    }

    public function getPartnersProperty(): Collection
    {
        return Partner::active()->get();
    }

    public function getProjectsProperty(): Collection
    {
        return Project::active()->limit(4)->get();
    }

    public function getAboutSectionProperty()
    {
        return Section::where('type', PageType::ABOUT)->active()->first();
    }

    public function getContactSectionProperty()
    {
        return Section::where('type', PageType::CONTACT)->active()->first();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.index')->extends('layouts.guest');
    }
}
