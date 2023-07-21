<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
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

    public $createPage;

    public $page;

    public $image;
    
    public $description;

    public $listeners = [
        'createPage',
    'editorjs-save:myEditor' => 'saveEditorState'
];
    
    public function saveEditorState($editorJsonData)
    {
        $this->description = $editorJsonData;
    }

    public array $rules = [
        'page.title'            => ['required', 'string', 'max:255'],
        'page.slug'             => ['required', 'unique:pages', 'max:255'],
        'description'          => ['required'],
        'page.meta_title'       => ['nullable|max:255'],
        'page.meta_description' => ['nullable|max:255'],
        'page.language_id'      => ['nullable'],
    ];

    public function mount(Page $page)
    {
        $this->page = $page;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('page_create'), 403);

        return view('livewire.admin.page.create');
    }

    public function createPage()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createPage = true;
    }

    public function create()
    {
        $this->validate();

        $this->page->slug = Str::slug($this->page->name);

        if ($this->image) {
            $imageName = Str::slug($this->page->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('pages', $imageName);
            $this->page->image = $imageName;
        }

        $this->page->description = $this->description;

        $this->page->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Page created successfully.'));

        $this->createPage = false;
    }
}
