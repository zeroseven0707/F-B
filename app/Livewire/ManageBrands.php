<?php

namespace App\Livewire;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageBrands extends Component
{
    use WithFileUploads;

    public $logo, $name;
    public $selectedId, $updateMode = false;

    public function render()
    {
        $brands = Brand::where('web_id',auth()->user()->id)->get();
        return view('livewire.manage-brands', compact('brands'));
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string',
            'logo' => 'required|image',
        ]);


        $imagePath = $this->logo->store('brands', 'public');

        Brand::create([
            'name' => $this->name,
            'logo' => $imagePath,
            'web_id' => Auth::user()->id
        ]);

        session()->flash('message', 'Brand created successfully.');

        $this->reset(['name', 'logo']);
    }

    public function edit($id)
    {
        $banner = Brand::findOrFail($id);
        $this->selectedId = $banner->id;
        $this->name = $banner->name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'logo' => 'required|image',
        ]);

        $brand = Brand::findOrFail($this->selectedId);
        $brand->name = $this->name;

        if ($this->logo) {
            // Delete existing image
            Storage::delete('public/' . $brand->logo);

            // Store new image
            $imagePath = $this->logo->store('brands', 'public');
            $brand->logo = $imagePath;
        }

        $brand->save();

        session()->flash('message', 'Brands updated successfully.');

        $this->reset(['name', 'logo', 'selectedId', 'updateMode']);
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        session()->flash('message', 'brand deleted successfully.');
    }
}
