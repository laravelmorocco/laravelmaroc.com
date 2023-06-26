<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public About $about;

    public $image;
    public $icon;
    public $inputs;
    public $block_title = [];
    public $block_content = [];
    public $block_title_1 = [];
    public $block_content_1 = [];

    protected $listeners = [
        'submit',
    ];

    public function mount(About $about)
    {
        $this->about = $about;
        $this->block_title = $about->block_title;
        $this->block_content = $about->block_content;

        $this->fill([
            'inputs' => collect([['block_title' => '', 'block_content' => '']]),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.about.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->about->slug = Str::slug($this->about->title);

        if ($this->image) {
            $imageName = Str::slug($this->about->title).'.'.$this->image->extension();
            $this->image->storeAs('abouts', $imageName);
            $this->about->image = $imageName;
        }

        $this->about->save();

        $this->alert('success', __('About updated successfully!'));

        return redirect()->route('admin.about.index');
    }

    public function addInput()
    {
        $this->inputs->push(['block_title' => '', 'block_content' => '']);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    protected function rules(): array
    {
        return [
            'about.language_id' => [
                'required',
            ],
            'about.status' => [
                'required',
            ],
            'about.image' => [
                'nullable',
            ],
            'about.title' => [
                'required',
                'max:191',
            ],
            'about.content' => [
                'required',
            ],
            'inputs.*.block_title' => [
                'max:191',
            ],
            'inputs.*.block_title' => [
                'max:255',
            ],
        ];
    }
}
