<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\About;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\About;
use App\Models\Language;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;
use Str;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $language_id;

    public array $listsForFields = [];

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable = (new About())->orderable;
        $this->initListsForFields();
    }

    public function render()
    {
        // $static = Section::where('page', 1)->where('language_id', $this->language_id)->first();

        $query = About::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $abouts = $query->paginate($this->perPage);

        return view('livewire.admin.about.index', compact('abouts'))
            ->extends('layouts.dashboard')
            ->section('content');
    }

      // About  Delete
      public function delete(About $about)
      {
          // abort_if(Gate::denies('about_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $about->delete();
          //   $this->alert('warning', __('About Deleted successfully!') );
      }

     // About  Clone
     public function clone(About $about)
     {
         $about_details = About::find($about->id);
         // dd($about_details);
         About::create([
             'language_id'   => $about_details->language_id,
             'title'         => $about_details->title,
             'slug'          => ! empty($about_details->slug) ? Str::slug($about_details->slug) : Str::slug($about_details->title),
             'image'         => $about_details->image,
             'content'       => $about_details->content,
             'block_content' => $about_details->block_content,
             'status'        => 0,
         ]);
         // $this->alert('success', __('About Cloned successfully!') );
     }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
