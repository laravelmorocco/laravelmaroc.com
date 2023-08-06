<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use App\Models\Service;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $project;

    public $images;

    public $image;
    
    public $description;

    public array $listsForFields = [];

    public $editModal = false;

    protected $listeners = [
        'editModal',
    ];

    protected $rules = [
        'project.title'            => 'required|max:191',
        'description'          => 'required',
        'project.client_name'      => 'required',
        'project.link'             => 'required',
        'project.service_id'       => 'required',
        'project.meta_title'       => 'nullable',
        'project.meta_description' => 'nullable',
        'project.language_id'      => 'required',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function editModal($project)
    {
        // abort_if(Gate::denies('project_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->project = Project::findOrfail($project);

        $this->description = $this->project->content;

        $this->editModal = true;
    }

    public function submit()
    {
        $this->project->slug = Str::slug($this->project->title);

        // Single image

        if ($this->image) {
            $imageName = Str::slug($this->project->title).'.'.$this->image->extension();
            $this->image->storeAs('projects', $imageName);
            $this->project->image = $imageName;
        }

        // Multiple images within an array
        // if (empty($this->images)) {
        //     foreach ($this->images as $key => $image) {
        //         $this->images[$key] = $image->store('/');
        //     }
        // }

        $this->images = json_encode($this->images);

        $this->project->gallery = $this->images;

        $this->project->content = $this->description;

        $this->project->save();

        $this->editModal = false;

        $this->emit('refreshIndex');

        $this->alert('success', __('Service updated successfully!'));
    }

    public function render()
    {
        return view('livewire.admin.project.edit');
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
