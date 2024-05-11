<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Livewire\Component;
use App\Models\Theme;

class WishlistWrite extends Component
{
    public $theme_id,$code;
    public $value;

    public function mount($code)
    {
        $theme = Theme::where('code', $code)->first();
        $wishlist = Wishlist::where('theme_id', $theme->id)->first();
        $code = $code;

        if ($wishlist) {
            $this->theme_id = $wishlist->theme_id;
            $this->value = $wishlist->value;
        } else {
            $this->theme_id = $theme->id;
            $this->value = null; // Atau nilai default jika tidak ada data
        }
    }

    public function render()
    {
        return view('livewire.wishlist-write');
    }

    public function save()
    {
        $this->validate([
            'value' => 'required',
        ]);

        // Simpan data ke dalam database
        Wishlist::updateOrCreate(
            ['theme_id' => $this->theme_id],
            ['value' => $this->value]
        );

        session()->flash('message', 'Data has been saved.');
    }
}
