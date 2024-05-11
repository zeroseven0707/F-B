<?php

namespace App\Livewire;

use App\Models\DetailProduct;
use Livewire\Component;
use App\Models\Theme;

class DetailProductWrite extends Component
{
    public $theme_id,$code;
    public $value;

    public function mount($code)
    {
        $theme = Theme::where('code', $code)->first();
        $detailProduct = DetailProduct::where('theme_id', $theme->id)->first();
        $code = $code;

        if ($detailProduct) {
            $this->theme_id = $detailProduct->theme_id;
            $this->value = $detailProduct->value;
        } else {
            $this->theme_id = $theme->id;
            $this->value = null; // Atau nilai default jika tidak ada data
        }
    }

    public function render()
    {
        return view('livewire.detail-product-write');
    }

    public function save()
    {
        $this->validate([
            'value' => 'required',
        ]);

        // Simpan data ke dalam database
        DetailProduct::updateOrCreate(
            ['theme_id' => $this->theme_id],
            ['value' => $this->value]
        );

        session()->flash('message', 'Data has been saved.');
    }
}
