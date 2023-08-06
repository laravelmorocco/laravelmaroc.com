<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Language;

use Livewire\Component;
use File;
use App;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;

final class Edit extends Component
{
    use LivewireAlert;

    /** @var string[] */
    public $listeners = ['editLanguage'];

    public array $languages = [];

    public $language;
    public $name;
    public $code;

    public $editLanguage = false;

    protected $rules = [
        'language.name' => 'required|max:191',
        'language.code' => 'required',
    ];

    public function editLanguage($id): void
    {
        $this->language = Language::findOrFail($id);

        $this->editLanguage = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->language->save();

        File::copy(App::langPath().('/en.json'), App::langPath().('/'.$this->code.'.json'));

        $this->alert('success', __('Data created successfully!'));

        $this->emit('resetIndex');

        $this->editLanguage = false;
    }

    public function render()
    {
        return view('livewire.admin.language.edit');
    }
}
