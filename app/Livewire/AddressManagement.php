<?php

namespace App\Livewire;

use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddressManagement extends Component
{
    public $address;

    public function mount()
    {
        $this->address = Alamat::where('web_id',auth()->user()->id)->first()->address ?? '';
    }

    public function render()
    {
        return view('livewire.address-management');
    }

    public function update()
    {
        $this->validate([
            'address' => 'required|string',
        ]);

        $address = Alamat::where('web_id',auth()->user()->id)->first();
        if (!$address) {
            Alamat::create([
                'address' => $this->address,
                "web_id" => Auth::user()->id
            ]);
        } else {
            $address->update([
                'address' => $this->address,
            ]);
        }

        session()->flash('message', 'Address updated successfully.');
    }
}
