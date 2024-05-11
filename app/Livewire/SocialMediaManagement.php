<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
class SocialMediaManagement extends Component
{
    use WithFileUploads;

    public $name, $link, $image;
    public $selectedId, $updateMode = false;

    public function render()
    {
        $socialMedias = SocialMedia::where('web_id',auth()->user()->id)->get();
        return view('livewire.social-media-management', compact('socialMedias'));
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string',
            'link' => 'required|string',
            'image' => 'required|image',
        ]);

        $imagePath = $this->image->store('social-media', 'public');

        SocialMedia::create([
            'name' => $this->name,
            'link' => $this->link,
            'web_id' => Auth::user()->id,
            'image' => $imagePath
        ]);

        session()->flash('message', 'Social media created successfully.');

        $this->reset(['name', 'link', 'image']);
    }

    public function edit($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        $this->selectedId = $id;
        $this->name = $socialMedia->name;
        $this->link = $socialMedia->link;
        $this->updateMode = true;
    }

    public function update()
{
    $this->validate([
        'name' => 'required|string',
        'link' => 'required|string',
    ]);

    $socialMedia = SocialMedia::findOrFail($this->selectedId);
    $socialMedia->name = $this->name;
    $socialMedia->link = $this->link;

    if ($this->image) {
        // Delete existing image
        Storage::delete('public/' . $socialMedia->image);

        // Store new image
        $imagePath = $this->image->store('social-media', 'public');
        $socialMedia->image = $imagePath;
    }

    $socialMedia->save();

    session()->flash('message', 'Social media updated successfully.');

    $this->reset(['name', 'link', 'selectedId', 'updateMode', 'image']);
}
    public function delete($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->delete();

        session()->flash('message', 'Social media deleted successfully.');
    }
}
