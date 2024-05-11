<?php

namespace App\Livewire;

use App\Models\Banners;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class BannerManagement extends Component
{

    use WithFileUploads;

    public $type, $link, $image;
    public $selectedId, $updateMode = false;

    public function render()
    {
        $banners = Banners::where('web_id',auth()->user()->id)->get();
        return view('livewire.banner-management', compact('banners'));
    }

    public function create()
    {
        $this->validate([
            'type' => 'required|in:default,body,body2',
            'link' => 'required|string',
            'image' => 'required|image',
        ]);


        $imagePath = $this->image->store('banners', 'public');

        Banners::create([
            'type' => $this->type,
            'link' => $this->link,
            'image' => $imagePath,
            'web_id' => Auth::user()->id
        ]);

        session()->flash('message', 'Banner created successfully.');

        $this->reset(['type', 'link', 'image']);
    }

    public function edit($id)
    {
        $banner = Banners::findOrFail($id);
        $this->selectedId = $id;
        $this->type = $banner->type;
        $this->link = $banner->link;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'type' => 'required|in:default,body,body2',
            'link' => 'required|string',
        ]);

        $banner = Banners::findOrFail($this->selectedId);
        $banner->type = $this->type;
        $banner->link = $this->link;

        if ($this->image) {
            // Delete existing image
            Storage::delete('public/' . $banner->image);

            // Store new image
            $imagePath = $this->image->store('banners', 'public');
            $banner->image = $imagePath;
        }

        $banner->save();

        session()->flash('message', 'Banner updated successfully.');

        $this->reset(['type', 'link', 'selectedId', 'updateMode', 'image']);
    }

    public function delete($id)
    {
        $banner = Banners::findOrFail($id);
        $banner->delete();

        session()->flash('message', 'Banner deleted successfully.');
    }
}
