<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $partner;

    public $editModal = false;

    public $image;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'partner.name'        => ['required', 'string', 'max:255'],
        'partner.slug'        => ['required', 'string'],
        'partner.description' => ['nullable', 'string'],
    ];

    public function getImagePreviewProperty()
    {
        return $this->partner?->image;
    }

    public function editModal($partner)
    {
        // abort_if(Gate::denies('partner_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->partner = Partner::findOrfail($partner);

        $this->editModal = true;
    }

    public function update()
    {
        // abort_if(Gate::denies('partner_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->partner->name).'-'.Str::random(5).'.'.$this->image->extension();

            // Delete the previous media file before updating
            $this->slider->clearMediaCollection('partners');

            $this->slider->addMediaFromDisk($this->image->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->partner->image = $imageName;
        }

        $this->partner->save();

        $this->alert('success', __('Partner updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.partners.edit');
    }
}
