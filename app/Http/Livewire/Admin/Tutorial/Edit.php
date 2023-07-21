<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Tutorial;

use App\Models\Tutorial;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $tutorial;

    public $image;

    public $description;

    public $editModal = false;

    protected $listeners = [
        'editModal',
    ];

    protected $rules = [
        'tutorial.language_id' => 'required',
        'tutorial.title'       => 'required|max:191',
        'tutorial.type'        => 'required',
        'tutorial.tags'    => 'nullable',
        'tutorial.options'     => 'nullable',
        'description'         => 'nullable',
    ];

    public function updatedDescription($value)
    {
        $this->service->content = $value;
    }

    public function editModal($tutorial)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = Tutorial::findOrFail($tutorial);

        $this->image = $this->service->image;

        $this->description = $this->service->content;

        $this->editModal = true;
    }

    public function render()
    {
        return view('livewire.admin.tutorial.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->service->slug = Str::slug($this->service->title);

        if (empty($this->image)) {
            $imageName = Str::slug($this->service->title).'.'.$this->image->extension();
            $this->image->storeAs('tutorials', $imageName);
            $this->service->image = $imageName;
        }

        $this->service->content = $this->description;

        $this->service->save();

        $this->alert('success', __('Tutorial updated successfully!'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }
}
