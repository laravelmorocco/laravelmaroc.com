<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    public string $perPage = '100';

    protected $listeners = [
        'refreshIndex' => '$refresh'
    ];
    public $links = []; 
    public $menu;
    public $menus;
    public $name;
    public $label;
    public $url;
    public $type;
    public $placement;
    public $parent_id;
    public $new_window;

    protected $rules = [
        'menus.*.name' => 'required',
        'menus.*.type' => 'required',
        'menus.*.placement' => 'nullable',
        'menus.*.label' => 'required',
        'menus.*.url' => 'required',
        'menus.*.parent_id' => 'nullable|exists:menus,id',
        'menus.*.new_window' => 'boolean',
        'menus.*.status' => 'boolean',
    ];

    public function mount()
    {
        $this->menus = Menu::when($this->placement, function ($query) {
            $query->where('placement', $this->placement);
        })->orderBy('sort_order')
        ->get()->toArray();

        $this->links = [
            'Link 1',
            'Link 2',
            'Link 3',
            // Add more links as needed
        ];
        
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function filterByPlacement($value)
    {
        $this->placement = $value;
        $this->mount();
    }

    public function render()
    {
        $menus = Menu::when($this->placement, function ($query) {
            $query->where('placement', $this->placement);
        })->paginate($this->perPage);

        return view('livewire.admin.menu.index', compact('menus'))->extends('layouts.dashboard');
    }


    public function update($id)
    {
        $this->menu = Menu::find($id);
        
        $this->validate();

        foreach ($this->menus as $menu) {
            $this->menu = Menu::find($menu['id']);
            $this->menu->name = $menu['name'];
            $this->menu->label = $menu['label'];
            $this->menu->type = $menu['type'];
            $this->menu->placement = $menu['placement'];
            $this->menu->url = $menu['url'];
            $this->menu->parent_id = $menu['parent_id'] ?? null;
            $this->menu->new_window = $menu['new_window'] ?? false;
            $this->menu->status = $menu['status'] ?? false;

            $this->menu->save();

        }
        $this->alert('success', __('Menu updated successfully.'));
    
        $this->reset(['name', 'label', 'url', 'type', 'placement', 'parent_id', 'new_window']);
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'placement' => 'required',
            'label' => 'required',
            'url' => 'required',
            'parent_id' => 'nullable|exists:menus,id',
            'new_window' => 'boolean',
        ]);
    
        $menu = new Menu();
        $menu->name = $this->name;
        $menu->label = $this->label;
        $menu->type = $this->type;
        $menu->placement = $this->placement;
        $menu->url = $this->url;
        $menu->parent_id = $this->parent_id ?? null;
        $menu->new_window = $this->new_window ?? false;
        $menu->status = $this->status ?? false;
    
        $menu->save();
    
        $this->alert('success', __('Menu created successfully.'));
    
        $this->mount();
    }

    public function updateMenuOrder($ids)
    {
        foreach ($ids as $index => $id) {
            $menu = Menu::find($id);
            $menu->sort_order = $index + 1;
            $menu->save();
        }
        $this->mount();
        $this->alert('success', __('Menu order updated successfully.'));
    }
    
    public function predefinedMenu(): void
    {
        $this->menus = [
            [
                'name' => 'Home',
                'type' => 'route',
                'label' => 'Home',
                'url' => 'home',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'name' => 'About',
                'type' => 'route',
                'label' => 'About',
                'url' => 'about',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'name' => 'Contact',
                'type' => 'route',
                'label' => 'Contact',
                'url' => 'contact',
                'parent_id' => null,
                'new_window' => false,
                'status' => true,
            ],
            [
                'name' => 'Login',
                'type' => 'route',
                'label' => 'Login',
                'url' => 'login',
                'parent_id' => null,
                'new_window' => false,
                'status' => true,
            ],
            [
                'name' => 'Register',
                'type' => 'route',
                'label' => 'Register',
                'url' => 'register',
                'parent_id' => null,
                'new_window' => false,
                'status' => true,
            ],
        ];
        // create the menus
        foreach ($this->menus as $menu) {
            Menu::create($menu);
        }
        $this->mount();
        $this->alert('success', __('Predefined menus created successfully.'));
    }

    public function delete(Menu $menu)
    {
        // abort_if(Gate::denies('menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->delete();
        $this->mount();
        $this->alert('success', __('Menu deleted successfully.'));
    }

    
}
