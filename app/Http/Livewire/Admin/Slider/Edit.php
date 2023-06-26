<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use App\Models\Slider;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Language;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal',
    ];

    public $editModal = false;

    public $slider;

    public $image;

    public $description;

    protected $rules = [
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string', 'max:255'],
        'description'          => ['nullable'],
        'slider.link'          => ['nullable', 'string'],
        'slider.language_id'   => ['nullable', 'integer'],
        'slider.bg_color'      => ['nullable', 'string'],
        'slider.embeded_video' => ['nullable'],
        'image'                => ['nullable'],
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function editModal(Slider $slider)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = $slider;

        $this->description = $this->slider->description;

        $this->image = $this->slider->image;

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->image->extension();

            $this->slider->clearMediaCollection('local_files');

            $this->slider->addMedia($this->image->getRealPath())
                ->toMediaCollection('local_files');

            $this->slider->image = $imageName;
        }

        $this->slider->description = $this->description;

        $this->slider->save();

        $this->alert('success', __('Slider updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }

    public function render(): View
    {
        return view('livewire.admin.slider.edit');
    }
}
