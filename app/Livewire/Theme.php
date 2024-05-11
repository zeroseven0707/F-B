<?php

namespace App\Livewire;

use App\Models\Theme as ModelsTheme;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class Theme extends Component
{
    use WithFileUploads;

    public $name;
    public $code;
    public $picture = [];
    public $selectedId, $updateMode = false;

    public function render()
    {
        $set = ModelsTheme::all();
        return view('livewire.theme', compact('set'));
    }

    public function create()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);

        $validatedData['code'] = Str::random(10);

        $picture = [];
        foreach ($this->picture as $picture) {
            $path = $picture->store('picture', 'public');
            $array[] = $path;
        }

        $validatedData['picture'] = $array;

        ModelsTheme::create($validatedData);

        session()->flash('message', 'Theme created successfully.');
        $this->reset(['name', 'code', 'picture']);
    }
}
