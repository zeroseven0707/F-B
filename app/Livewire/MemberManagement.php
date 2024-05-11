<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MemberManagement extends Component
{
    public $members, $pagination, $selectedLevels = [];

    public function mount()
    {
        $response = Http::withHeaders([
            'X-API-Key' => config('app.api_key')
        ])->get('https://api.upos-conn.com/master/v1.3/api/PosPelanggan-showAllMember/9');
        $this->members = $response->json()['data'];
        $this->pagination = $response->json()['pagination'];

        // Inisialisasi selectedLevels dengan default value untuk setiap member
        foreach ($this->members as $member) {
            $this->selectedLevels[$member['posPelangganId']] = $member['member_status'];
        }
    }

    public function render()
    {
        return view('livewire.member-management');
    }
    public function updateLevel($memberId)
    {
        $response = Http::withHeaders([
            'X-API-Key' => config('app.api_key')
        ])->asForm()->put('https://api.upos-conn.com/master/v1.3/api/PosPelanggan-updateStatusMember/' . $memberId, [
            'posMember_status' => $this->selectedLevels[$memberId]
        ]);
    
        // Tambahkan logika untuk menangani respon atau feedback dari API jika diperlukan
    
        // Refresh data setelah pembaruan
        $this->mount();
    }
}
