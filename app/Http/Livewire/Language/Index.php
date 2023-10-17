<?php

declare(strict_types=1);

namespace App\Http\Livewire\Language;

use Livewire\Component;
use App\Models\Language;
use Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;

final class Index extends Component
{
    use LivewireAlert;

    public $languages = [];

    public $language;

    protected $listeners = [
        'refreshIndex' => '$refresh',
    ];

    public function mount(): void
    {
        $this->languages = Language::all()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.language.index');
    }

    public function onSetDefault($id): void
    {
        Language::where('is_default', '=', true)->update(['is_default' => false]);

        $this->language = Language::findOrFail($id);

        $this->language->is_default = true;

        $this->language->save();

        $this->alert('success', __('Language updated successfully!'));
    }

    public function sync($id): void
    {
        $languages = Language::findOrFail($id);

        Artisan::call('translatable:export', ['lang' => $languages->code]);

        $this->alert('success', __('Translation updated successfully!'));
    }

    public function delete(Language $language): void
    {
        $language->delete();

        $this->alert('warning', __('Language deleted successfully!'));
    }
}
