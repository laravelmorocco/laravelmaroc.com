<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use App\Models\Tutorial;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $tutorial;

    public $images;

    public $image;

    public $description;

    public array $listsForFields = [];

    public $editModal = false;

    protected $listeners = [
        'editModal',
    ];

    protected $rules = [
        'tutorial.title'            => 'required|max:191',
        'description'               => 'required',
        'tutorial.client_name'      => 'required',
        'tutorial.link'             => 'required',
        'tutorial.user_id'          => 'required',
        'tutorial.meta_title'       => 'nullable',
        'tutorial.meta_description' => 'nullable',
        'tutorial.language_id'      => 'required',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function editModal($tutorial)
    {
        // abort_if(Gate::denies('tutorial_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->tutorial = Project::findOrfail($tutorial);

        $this->description = $this->tutorial->content;

        $this->editModal = true;
    }

    public function submit()
    {
        $this->tutorial->slug = Str::slug($this->tutorial->title);

        // Single image

        if ($this->image) {
            $imageName = Str::slug($this->tutorial->title).'.'.$this->image->extension();
            $this->image->storeAs('tutorials', $imageName);
            $this->tutorial->image = $imageName;
        }

        // Multiple images within an array
        // if (empty($this->images)) {
        //     foreach ($this->images as $key => $image) {
        //         $this->images[$key] = $image->store('/');
        //     }
        // }

        $this->images = json_encode($this->images);

        $this->tutorial->gallery = $this->images;

        $this->tutorial->content = $this->description;

        $this->tutorial->save();

        $this->editModal = false;

        $this->emit('refreshIndex');

        $this->alert('success', __('Project updated successfully!'));
    }

    public function render()
    {
        return view('livewire.admin.tutorial.edit');
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }

    public function getProjectsProperty()
    {
        return Project::select('title', 'id')->get();
    }
}
