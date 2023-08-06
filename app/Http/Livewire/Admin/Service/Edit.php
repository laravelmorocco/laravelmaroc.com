<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $service;

    public $image;

    public $description;

    public $editModal = false;

    protected $listeners = [
        'editModal',
    ];

    protected $rules = [
        'service.language_id' => 'required',
        'service.title'       => 'required|max:191',
        'service.type'        => 'required',
        'service.features'    => 'nullable',
        'service.options'     => 'nullable',
        'description'         => 'nullable',
    ];

    public function updatedDescription($value)
    {
        $this->service->content = $value;
    }

    public function editModal($service)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = Service::findOrFail($service);

        $this->image = $this->service->image;

        $this->description = $this->service->content;

        $this->editModal = true;
    }

    public function render()
    {
        return view('livewire.admin.service.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->service->slug = Str::slug($this->service->title);

        if (empty($this->image)) {
            $imageName = Str::slug($this->service->title).'.'.$this->image->extension();
            $this->image->storeAs('services', $imageName);
            $this->service->image = $imageName;
        }

        $this->service->content = $this->description;

        $this->service->save();

        $this->alert('success', __('Service updated successfully!'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }
}
