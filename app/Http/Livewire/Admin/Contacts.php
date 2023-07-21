<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Contacts extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public $showDeleteModal = false;

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

    protected $listeners = ['reRenderParent'];

    public function reRenderParent()
    {
        $this->mount();
        $this->render();
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
        $this->paginationOptions = config('tutorial.pagination.options');
        $this->orderable = (new Contact())->orderable;
    }

    public function render()
    {
        $query = Contact::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $contacts = $query->paginate($this->perPage);

        return view('livewire.admin.contacts', compact('contacts'))
            ->extends('layouts.dashboard')
            ->section('content');
    }

    public function deleteSelected()
    {
        Contact::whereIn('id', $this->selected)->delete();

        $this->showDeleteModal = false;

        $this->resetSelected();

        $this->reRenderParent();
    }

    public function delete(Contact $contact)
    {
        $contact->delete();

        $this->alert('warning', __('Contact deleted successfully!'));

        $this->reRenderParent();
    }
}
