<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Project;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Gate;
use Str;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $language_id;

    public $tutorial;

    public $showModal = false;

    public $deleteModal = false;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'importModal',
        'delete',
    ];

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

    public function confirmed()
    {
        $this->emit('delete');
    }

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
        $this->orderable = (new Project())->orderable;
    }

    public function render()
    {
        $query = Project::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $tutorials = $query->paginate($this->perPage);

        return view('livewire.admin.tutorial.index', compact('tutorials'))->extends('layouts.dashboard');
    }

    public function showModal(Project $tutorial)
    {
        // abort_if(Gate::denies('tutorial_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->tutorial = $tutorial;

        $this->showModal = true;
    }

    public function deleteModal($tutorial)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->tutorial = $tutorial;
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('tutorial_delete'), 403);

        Project::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete()
    {
        abort_if(Gate::denies('tutorial_delete'), 403);

        Project::findOrFail($this->tutorial)->delete();

        $this->alert('success', __('Project deleted successfully.'));
    }

    // Project  Clone
    public function clone(Project $tutorial)
    {
        $portfolio_details = Project::find($tutorial->id);
        // dd($portfolio_details);
        Project::create([
            'user_id'          => $portfolio_details->user_id,
            'language_id'      => $portfolio_details->language_id,
            'title'            => $portfolio_details->title,
            'slug'             => ! empty($portfolio_details->slug) ? Str::slug($portfolio_details->slug) : Str::slug($portfolio_details->title),
            'content'          => $portfolio_details->content,
            'client_name'      => $portfolio_details->client_name,
            'link'             => $portfolio_details->link,
            'featured_image'   => $portfolio_details->featured_image,
            'gallery'          => $portfolio_details->gallery,
            'status'           => 0,
            'meta_title'       => $portfolio_details->meta_title,
            'meta_description' => $portfolio_details->meta_description,
        ]);
        // $this->alert('success', __('Project Cloned successfully!') );
    }
}
