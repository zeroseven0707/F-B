<?php

namespace App\Livewire;

use App\Models\Theme;
use Livewire\Component;

class ThemeDetail extends Component
{
    public $code;

    public function mount($code)
    {
        $this->code = $code;
    }

    public function render()
    {
        // Gunakan $this->code di sini untuk melakukan operasi dengan code
        $theme = Theme::where('code',$this->code)->first();

        return view('livewire.theme-detail', ['theme' => $theme]);
    }
}
