<?php

namespace App\Livewire;

use App\Models\AboutUs;
use Livewire\Component;
use App\Models\Theme;

class AboutWrite extends Component
{
    public $theme_id,$code;
    public $value;

    public function mount($code)
    {
        $theme = Theme::where('code', $code)->first();
        $about = AboutUs::where('theme_id', $theme->id)->first();
        $code = $code;

        if ($about) {
            $this->theme_id = $about->theme_id;
            $this->value = $about->value;
        } else {
            $this->theme_id = $theme->id;
            $this->value = null; // Atau nilai default jika tidak ada data
        }
    }

    public function render()
    {
        return view('livewire.about-write');
    }

    public function save()
    {
        $this->validate([
            'value' => 'required',
        ]);

        // Simpan data ke dalam database
        AboutUs::updateOrCreate(
            ['theme_id' => $this->theme_id],
            ['value' => $this->value]
        );

        session()->flash('message', 'Data has been saved.');
    }
}
