<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Developer;

use App\Models\Developer;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $developer;

    public $editModal = false;

    public $image;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'developer.name'        => ['required', 'string', 'max:255'],
        'developer.slug'        => ['required', 'string'],
        'developer.description' => ['nullable', 'string'],
    ];

    public function getImagePreviewProperty()
    {
        return $this->developer?->image;
    }

    public function editModal($developer)
    {
        // abort_if(Gate::denies('developer_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->developer = Developer::findOrfail($developer);

        $this->editModal = true;
    }

    public function update()
    {
        // abort_if(Gate::denies('developer_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->developer->name).'-'.Str::random(5).'.'.$this->image->extension();

            // Delete the previous media file before updating
            $this->slider->clearMediaCollection('local_files');

            $this->slider->addMediaFromDisk($this->image->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->developer->image = $imageName;
        }

        $this->developer->save();

        $this->alert('success', __('Developer updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.developers.edit');
    }
}
