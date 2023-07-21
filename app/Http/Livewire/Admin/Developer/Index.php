<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Developer;

use App\Http\Livewire\Utils\WithSorting;
use App\Imports\DevelopersImport;
use App\Models\Developer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $developer;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'delete',
    ];

    public $deleteModal = false;

    public $showModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

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

    public function getImagePreviewProperty()
    {
        return $this->developer?->image;
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

    public function confirmed()
    {
        $this->emit('delete');
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Developer())->orderable;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('developer_access'), 403);

        $query = Developer::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $developers = $query->paginate($this->perPage);

        return view('livewire.admin.developers.index', compact('developers'))->extends('layouts.dashboard');
    }

    public function showModal(Developer $developer)
    {
        // abort_if(Gate::denies('developer_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->developer = $developer;

        $this->showModal = true;
    }

    public function deleteModal($developer)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->developer = $developer;
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('developer_delete'), 403);

        Developer::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete()
    {
        abort_if(Gate::denies('developer_delete'), 403);

        Developer::findOrFail($this->developer)->delete();

        $this->alert('success', __('Developer deleted successfully.'));
    }

    public function importModal()
    {
        // abort_if(Gate::denies('developer_create'), 403);

        $this->importModal = true;
    }

    public function import()
    {
        // abort_if(Gate::denies('developer_create'), 403);

        $this->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new DevelopersImport(), $this->file);

        $this->alert('success', __('Developer imported successfully.'));
    }
}
