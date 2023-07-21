<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Language;
use Illuminate\Support\Collection;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createModal = false;

    public $blog;

    public $image;

    public $description;

    public $listeners = ['createModal'];

    protected $rules = [
        'blog.title'            => 'required|min:3|max:255',
        'blog.category_id'      => 'required|integer',
        'blog.slug'      => 'required|string',
        'description'           => 'required|min:3',
        'blog.language_id'      => 'nullable|integer',
        'blog.meta_title'       => 'nullable|max:100',
        'blog.meta_description' => 'nullable|max:200',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.create');
    }

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->blog = new Blog();

        $this->description = "";

        $this->blog->slug = Str::slug($this->blog->title);
        
        $this->blog->meta_title = $this->blog->title;

        $this->blog->meta_description = $this->blog->description;

        $this->createModal = true;
    }

    public function create()
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->blog->title).'.'.$this->image->extension();
            $this->image->storeAs('blogs', $imageName);
            $this->blog->image = $imageName;
        }

        $this->blog->description = $this->description;

        $this->blog->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Blog created successfully.'));

        $this->createModal = false;
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }
  
    public function getBlogCategoriesProperty()
    {
        return BlogCategory::pluck('title', 'id')->toArray();
    }
}
