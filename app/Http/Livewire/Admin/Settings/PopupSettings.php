<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use App\Http\Livewire\Utils\WithSorting;
use App\Models\Popup;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class PopupSettings extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithSorting;

    public $popup;

    public $popupModal = false;

    public $name;
    
    public $width;

    public $frequency;

    public $timing;

    public $delay;

    public $duration;

    public $backgroundColor;

    public $content;

    public $ctaText;

    public $ctaUrl;
    
    public $editing;

    public $listners = [
        'popupModal'
    ];

    public array $rules = [
        'width'           => ['required', 'string', 'max:15'],
        'frequency'       => ['nullable', 'string'],
        'timing'          => ['nullable', 'string', 'max:255'],
        'delay'           => ['nullable', 'string'],
        'duration'        => ['nullable', 'string', 'max:255'],
        'backgroundColor' => ['nullable', 'string', 'max:15'],
        'content'         => ['required', 'string'],
        'ctaText'         => ['required', 'string'],
        'ctaUrl'          => ['required', 'string'],
    ];

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

    public function setDefault($id)
    {
        Popup::where('is_default', '=', true)->update(['is_default' => false]);

        $this->popup = Popup::findOrFail($id);

        $this->popup->is_default = true;

        $this->popup->save();
    }

    public function popupModal(Popup $popup = null)
    {
        $this->resetValidation(); // Reset any previous validation errors
    
        if ($popup) {
            $this->popup = $popup;
            $this->editing = true;
        } else {
            $this->popup = new Popup();
            $this->editing = false;
        }
    
        $this->popupModal = true;
    }
    

    public function save()
    {
        $this->validate();

        if ($this->editing) {
            // Editing an existing popup
            $this->popup->update([
                'name'           => $this->name,
                'width'          => $this->width,
                'frequency'      => $this->frequency,
                'timing'         => $this->timing,
                'delay'          => $this->delay,
                'duration'       => $this->duration,
                'backgroundColor' => $this->backgroundColor,
                'content'        => $this->content,
                'ctaText'        => $this->ctaText,
                'ctaUrl'         => $this->ctaUrl,
            ]);
    
            $this->alert('success', __('Popup settings updated successfully!'));
        } else {
            $this->popup = Popup::create([
                'name'           => $this->name,
                'width'          => $this->width,
                'frequency'      => $this->frequency,
                'timing'         => $this->timing,
                'delay'          => $this->delay,
                'duration'       => $this->duration,
                'backgroundColor' => $this->backgroundColor,
                'content'        => $this->content,
                'ctaText'        => $this->ctaText,
                'ctaUrl'         => $this->ctaUrl,
            ]);

            $this->alert('success', __('Popup settings created successfully !'));
        }

        $this->popupModal = false;
        // } catch (Throwable $th) {
            // show error message
            // $this->alert('warning', __('Something not working !'));
        // }
    }

    public function render()
    {
        $popups = Popup::all();

        return view('livewire.admin.settings.popup-settings', compact('popups'));
    }
}
