<?php

namespace App\Livewire;

use App\Models\SetWebsite;
use App\Models\Theme;
use Livewire\Component;

class ThemeViewUsers extends Component
{
    public $themes;

    public function mount()
    {
        $this->themes = Theme::all();
    }

    public function render()
    {
        return view('livewire.theme-view-users');
    }
    public function useTheme($themeId)
{
    $userId = auth()->id(); // Mendapatkan id pengguna yang sedang login
    // Cek apakah sudah ada data dengan theme_id dan web_id yang sama
    $existingSetWebsite = SetWebsite::where('web_id', $userId)->first();

    if ($existingSetWebsite) {
        // Jika sudah ada, update data
        $existingSetWebsite->update([
            'theme_id' => $themeId
        ]);
    } else {
        // Jika belum ada, buat data baru
        SetWebsite::create([
            'theme_id' => $themeId,
            'web_id' => $userId,
        ]);
    }

    session()->flash('message', 'Theme has been set.'); // Tampilkan pesan sukses
}
}
