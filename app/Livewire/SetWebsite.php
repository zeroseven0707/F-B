<?php

namespace App\Livewire;

use App\Models\SetWebsite as ModelsSetWebsite;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class SetWebsite extends Component
{
    public $question, $answer, $faq_id, $updateMode = false;


    use WithFileUploads;

    public $name;
    public $code;
    public $pictures = [];

    public function render()
    {
        $set = ModelsSetWebsite::all();
        return view('livewire.set-website', compact('set'));
    }

    public function create()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif,svg', // Max 2MB per picture
        ]);

        $validatedData['code'] = Str::random(10);

        $pictures = [];
        foreach ($this->pictures as $picture) {
            $path = $picture->store('pictures', 'public');
            $pictures[] = $path;
        }

        $validatedData['pictures'] = $pictures;

        ModelsSetWebsite::create($validatedData);

        session()->flash('message', 'Theme created successfully.');
        $this->reset(['name', 'code', 'pictures']);
    }
}
