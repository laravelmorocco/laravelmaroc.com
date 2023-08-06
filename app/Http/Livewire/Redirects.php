<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\Redirect;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

final class Redirects extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithSorting;

    public $listeners = ['delete', 'refreshIndex' => '$refresh'];

    public $editModal = false;

    public $redirect;

    public $refreshIndex;

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

    protected $rules = [
        'redirect.old_url' => 'required',
        'redirect.new_url' => 'nullable',
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Redirect())->orderable;
    }

    public function editModal($id): void
    {
        $this->redirect = Redirect::find($id);
        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->redirect->save();

        $this->alert('warning', __('Redirect updated successfully!'));

        $this->editModal = false;

        $this->emit('refreshIndex');
    }

    public function delete(Redirect $redirect): void
    {
        $redirect->delete();

        $this->alert('warning', __('Redirect deleted successfully!'));
    }

    public function render(): View|Factory
    {
        $query = Redirect::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $redirects = $query->paginate($this->perPage);

        return view('livewire.admin.settings.redirects', compact('redirects'));
    }
}
