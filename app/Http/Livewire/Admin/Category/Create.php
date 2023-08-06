<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = ['createModal'];

    public $createModal;

    public $category;

    public $image;

    protected $rules = [
        'category.name'        => ['required', 'max:255'],
        'category.description' => ['required'],
    ];

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.category.create');
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createModal = true;
    }

    public function create()
    {
        $this->validate();

        $this->category->slug = Str::slug($this->category->name);

        if ($this->image) {
            $imageName = Str::slug($this->category->name).'-'.Str::random(3).'.'.$this->image->extension();
            $this->category->addMedia($this->image)->toMediaCollection('local_files');
            $this->category->images = $imageName;
        }

        $this->category->save();

        $this->emit('refreshIndex');

        $this->alert('success', 'Category created successfully.');

        $this->createModal = false;
    }
}
