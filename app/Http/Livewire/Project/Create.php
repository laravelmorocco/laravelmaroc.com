<?php

declare(strict_types=1);

namespace App\Http\Livewire\Project;

use App\Models\Project;
use App\Models\Service;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

final class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $project;

    public $image;

    public $images;

    public $description;

    public $createModal = false;

    protected $listeners = [
        'createModal',
    ];

    protected $rules = [
        'project.title'            => 'required|unique:projects,title|max:191',
        'description'          => 'required',
        'project.client_name'      => 'required',
        'project.link'             => 'required',
        'project.service_id'       => 'required',
        'project.meta_title'       => 'nullable',
        'project.meta_description' => 'nullable',
        'project.language_id'      => 'required',
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->project = new Project();

        $this->description = "";

        $this->createModal = true;
    }

    public function submit(): void
    {
        $this->project->slug = Str::slug($this->project->title);

        if ($this->image) {
            $imageName = Str::slug($this->project->title).'.'.$this->image->extension();
            $this->image->storeAs('projects', $imageName);
            $this->project->image = $imageName;
        }

        // Multiple images within an array

        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->store('project', 'public');
        }

        $this->images = json_encode($this->images);

        $this->project->gallery = $this->images;

        $this->project->description = $this->description;

        $this->project->save();

        $this->alert('success', __('Service created successfully!'));

        $this->emit('refreshIndex');

        $this->createModal = false;
    }

    public function render()
    {
        return view('livewire.admin.project.create');
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }

    public function getServicesProperty()
    {
        return Service::select('title', 'id')->get();
    }
}
