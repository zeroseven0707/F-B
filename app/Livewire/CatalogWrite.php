<?php

namespace App\Livewire;

use App\Models\Katalog;
use Livewire\Component;
use App\Models\Theme;

class CatalogWrite extends Component
{
    public $theme_id,$code;
    public $value;

    public function mount($code)
    {
        $theme = Theme::where('code', $code)->first();
        $catalog = Katalog::where('theme_id', $theme->id)->first();
        $code = $code;

        if ($catalog) {
            $this->theme_id = $catalog->theme_id;
            $this->value = $catalog->value;
        } else {
            $this->theme_id = $theme->id;
            $this->value = null; // Atau nilai default jika tidak ada data
        }
    }

    public function render()
    {
        return view('livewire.catalog-write');
    }

    public function save()
    {
        $this->validate([
            'value' => 'required',
        ]);

        // Simpan data ke dalam database
        Katalog::updateOrCreate(
            ['theme_id' => $this->theme_id],
            ['value' => $this->value]
        );

        session()->flash('message', 'Data has been saved.');
    }
}
