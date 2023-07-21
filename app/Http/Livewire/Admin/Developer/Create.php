<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Developer;

use App\Models\Developer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createModal;

    public $developer;

    public $image;

    public $image_url = null;

    public $listeners = ['createModal'];

    protected $rules = [
        'developer.name'        => ['required', 'string', 'max:255'],
        'developer.description' => ['nullable', 'string'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('developer_create'), 403);

        return view('livewire.admin.developer.create');
    }

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->developer = new Developer();

        $this->createModal = true;
    }

    public function create()
    {
        $this->validate();

        $this->developer->slug = Str::slug($this->developer->name);

        if ($this->image_url) {
            $image = file_get_contents($this->image_url);

            $imageName = Str::slug($this->developer->name);

            $this->developer->addMediaFromDisk($image->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->developer->image = $imageName;
        }

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->developer->name).'.'.$this->image->extension();

            $this->developer->addMediaFromDisk($this->image->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->developer->image = $imageName;
        }

        $this->developer->save();

        $this->alert('success', __('Developer created successfully.'));

        $this->emit('refreshIndex');

        $this->createModal = false;
    }
}
