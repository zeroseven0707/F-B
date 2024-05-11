<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Theme;

class CartWrite extends Component
{
    public $theme_id,$code;
    public $value;

    public function mount($code)
    {
        $theme = Theme::where('code', $code)->first();
        $cart = Cart::where('theme_id', $theme->id)->first();
        $code = $code;

        if ($cart) {
            $this->theme_id = $cart->theme_id;
            $this->value = $cart->value;
        } else {
            $this->theme_id = $theme->id;
            $this->value = null; // Atau nilai default jika tidak ada data
        }
    }

    public function render()
    {
        return view('livewire.cart-write');
    }

    public function save()
    {
        $this->validate([
            'value' => 'required',
        ]);

        // Simpan data ke dalam database
        Cart::updateOrCreate(
            ['theme_id' => $this->theme_id],
            ['value' => $this->value]
        );

        session()->flash('message', 'Data has been saved.');
    }
}
