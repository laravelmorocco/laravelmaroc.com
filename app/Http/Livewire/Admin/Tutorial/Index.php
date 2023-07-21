<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Tutorial;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\Tutorial;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;


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

    public $deleteModal = false;

    public $showModal = false;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'delete',
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
        $this->paginationOptions = config('tutorial.pagination.options');
        $this->orderable = (new Tutorial())->orderable;
    }

    public function render()
    {
        // $static = Tutorial::where('page', 4)->where('language_id', $this->language_id)->first();

        $query = Tutorial::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $tutorials = $query->paginate($this->perPage);

        return view('livewire.admin.tutorial.index', compact('tutorials'))
            ->extends('layouts.dashboard');
    }

    public function showModal(Tutorial $tutorial)
    {
        abort_if(Gate::denies('service_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = $tutorial;

        $this->showModal = true;
    }

    public function delete()
    {
        abort_if(Gate::denies('service_delete'), 403);

        Tutorial::findOrFail($this->service)->delete();

        $this->alert('success', __('Tutorial deleted successfully.'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('service_delete'), 403);

        Tutorial::whereIn('id', $this->selected)->delete();

        $this->resetSelected();

        $this->alert('success', __('Tutorial deleted successfully.'));
    }

    public function confirmed()
    {
        $this->emit('delete');
    }

    public function deleteModal($tutorial)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->service = $tutorial;
    }

     // Tutorial  Clone
     public function clone(Tutorial $tutorial)
     {
         $tutorial_details = Tutorial::find($tutorial->id);
         // dd($tutorial_details);
         Tutorial::create([
             'language_id' => $tutorial_details->language_id,
             'title'       => $tutorial_details->title,
             'slug'        => $tutorial_details->slug,
             'image'       => $tutorial_details->image,
             'content'     => $tutorial_details->content,
             'status'      => 0,
         ]);
         $this->alert('success', __('Tutorial Cloned successfully!') );
     }
}
