<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use App\Models\Tutorial;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $tutorial;

    public $image;

    public $images;
    
    public $description;

    public $createModal = false;

    protected $listeners = [
        'createModal',
    ];

    protected $rules = [
        'tutorial.title'            => 'required|unique:tutorials,title|max:191',
        'description'          => 'required',
        'tutorial.client_name'      => 'required',
        'tutorial.link'             => 'required',
        'tutorial.user_id'       => 'required',
        'tutorial.meta_title'       => 'nullable',
        'tutorial.meta_description' => 'nullable',
        'tutorial.language_id'      => 'required',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->tutorial = new Project();

        $this->description = "";

        $this->createModal = true;
    }

    public function submit()
    {
        $this->tutorial->slug = Str::slug($this->tutorial->title);

        if ($this->image) {
            $imageName = Str::slug($this->tutorial->title).'.'.$this->image->extension();
            $this->image->storeAs('tutorials', $imageName);
            $this->tutorial->image = $imageName;
        }

        // Multiple images within an array

        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->store('tutorial', 'public');
        }

        $this->images = json_encode($this->images);

        $this->tutorial->gallery = $this->images;

        $this->tutorial->description = $this->description;

        $this->tutorial->save();

        $this->alert('success', __('Project created successfully!'));

        $this->emit('refreshIndex');

        $this->createModal = false;
    }

    public function render()
    {
        return view('livewire.admin.tutorial.create');
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
