<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Service;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\Service;
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

    public $service;

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
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable = (new Service())->orderable;
    }

    public function render()
    {
        // $static = Service::where('page', 4)->where('language_id', $this->language_id)->first();

        $query = Service::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $services = $query->paginate($this->perPage);

        return view('livewire.admin.service.index', compact('services'))
            ->extends('layouts.dashboard');
    }

    public function showModal(Service $service)
    {
        abort_if(Gate::denies('service_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = $service;

        $this->showModal = true;
    }

    public function delete()
    {
        abort_if(Gate::denies('service_delete'), 403);

        Service::findOrFail($this->service)->delete();

        $this->alert('success', __('Service deleted successfully.'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('service_delete'), 403);

        Service::whereIn('id', $this->selected)->delete();

        $this->resetSelected();

        $this->alert('success', __('Service deleted successfully.'));
    }

    public function confirmed()
    {
        $this->emit('delete');
    }

    public function deleteModal($service)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->service = $service;
    }

     // Service  Clone
     public function clone(Service $service)
     {
         $service_details = Service::find($service->id);
         // dd($service_details);
         Service::create([
             'language_id' => $service_details->language_id,
             'title'       => $service_details->title,
             'slug'        => $service_details->slug,
             'image'       => $service_details->image,
             'content'     => $service_details->content,
             'status'      => 0,
         ]);
         $this->alert('success', __('Service Cloned successfully!') );
     }
}
