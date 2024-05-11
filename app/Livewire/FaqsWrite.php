<?php

namespace App\Livewire;

use App\Models\FaqsView;
use App\Models\Theme;
use Livewire\Component;

class FaqsWrite extends Component
{
    public $theme_id,$code;
    public $value;

    public function mount($code)
    {
        $theme = Theme::where('code', $code)->first();
        $faqsview = FaqsView::where('theme_id', $theme->id)->first();
        $code = $code;

        if ($faqsview) {
            $this->theme_id = $faqsview->theme_id;
            $this->value = $faqsview->value;
        } else {
            $this->theme_id = $theme->id;
            $this->value = null; // Atau nilai default jika tidak ada data
        }
    }

    public function render()
    {
        return view('livewire.faqs-write');
    }

    public function save()
    {
        $this->validate([
            'value' => 'required',
        ]);

        // Simpan data ke dalam database
        FaqsView::updateOrCreate(
            ['theme_id' => $this->theme_id],
            ['value' => $this->value]
        );

        session()->flash('message', 'Data has been saved.');
    }
}
