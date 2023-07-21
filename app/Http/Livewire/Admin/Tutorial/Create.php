<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Tutorial;

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

    public $description;

    public $createModal = false;

    protected $listeners = [
        'createModal',
    ];

    protected $rules = [
        'tutorial.language_id' => 'required',
        'tutorial.title'       => 'required|unique:tutorials,title|max:191',
        'tutorial.type'        => 'required',
        'tutorial.tags'        => 'nullable',
        'tutorial.options'     => 'nullable',
        'description'          => 'nullable',
    ];

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = new Tutorial();

        $this->description = '';

        $this->createModal = true;
    }

    public function render()
    {
        return view('livewire.admin.tutorial.create');
    }

    public function submit()
    {
        $this->validate();

        $this->service->slug = Str::slug($this->service->title);

        if ($this->image) {
            $imageName = Str::slug($this->service->title).'.'.$this->image->extension();
            $this->image->storeAs('tutorials', $imageName);
            $this->service->image = $imageName;
        }

        $this->service->content = $this->description;

        $this->service->save();

        $this->alert('success', __('Tutorial created successfully!'));

        $this->emit('refreshIndex');

        $this->createModal = false;
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }
}
