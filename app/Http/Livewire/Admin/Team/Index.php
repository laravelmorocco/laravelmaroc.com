<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Team;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\Language;
use App\Models\Section;
use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;

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
        $this->orderable = (new Team())->orderable;
        $this->initListsForFields();
    }

    public function render()
    {
        // $static = Section::where('page', 2)->where('language_id', $this->language_id)->first();

        $query = Team::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $teams = $query->paginate($this->perPage);

        return view('livewire.admin.team.index', compact('teams'));
    }

      // Team  Delete
      public function delete(Team $team)
      {
          // abort_if(Gate::denies('team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
          $team->delete();
          //   $this->alert('warning', __('Team Deleted successfully!') );
      }

     // Team  Clone
     public function clone(Team $team)
     {
         $team_details = Team::find($team->id);
         // dd($team_details);
         Team::create([
             'language_id' => $team_details->language_id,
             'name'        => $team_details->name,
             'image'       => $team_details->image,
             'content'     => $team_details->content,
             'role'        => $team_details->role,
             'status'      => 0,
         ]);
         // $this->alert('success', __('Team Cloned successfully!') );
     }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
