<?php

namespace App\Livewire;

use App\Models\Logo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class LogoManagement extends Component
{
    use WithFileUploads;

    public $image;

    public function mount()
    {
        $this->refreshLogo();
    }

    public function render()
    {
        return view('livewire.logo-management');
    }

    public function update()
    {
        $this->validate([
            'image' => 'required', // Max file size 1MB
        ]);

        $logo = Logo::where('web_id',auth()->user()->id)->first();
        if (!$logo) {
            Logo::create([
                'image' => $this->image->store('logos'),
                'web_id'=> Auth::user()->id
            ]);
        } else {
            Storage::disk('public')->delete($logo->image);
            $logo->update([
                'image' => $this->image->store('logos'),
            ]);
        }

        session()->flash('message', 'Logo updated successfully.');
        $this->refreshLogo();
    }

    public function refreshLogo()
    {
        $this->image = Logo::where('web_id',auth()->user()->id)->first()->image ?? null;
    }

}
