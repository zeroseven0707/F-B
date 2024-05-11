<?php

namespace App\Livewire;

use App\Models\Home;
use App\Models\Theme;
use Livewire\Component;

class HomeWrite extends Component
{
    public $theme_id,$code;
    public $value;

    public function mount($code)
    {
        $theme = Theme::where('code', $code)->first();
        $home = Home::where('theme_id', $theme->id)->first();
        $code = $code;

        if ($home) {
            $this->theme_id = $home->theme_id;
            $this->value = $home->value;
        } else {
            $this->theme_id = $theme->id;
            $this->value = null; // Atau nilai default jika tidak ada data
        }
    }

    public function render()
    {
        return view('livewire.home-write');
    }

    public function save()
    {
        $this->validate([
            'value' => 'required',
        ]);

        // Simpan data ke dalam database
        Home::updateOrCreate(
            ['theme_id' => $this->theme_id],
            ['value' => $this->value]
        );

        session()->flash('message', 'Data has been saved.');
    }
}
