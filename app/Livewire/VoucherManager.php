<?php

namespace App\Livewire;

use App\Models\Vouchers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class VoucherManager extends Component
{
    use WithFileUploads;

    public $vouchers, $code, $image, $type, $usage_limits, $qty, $min_spend, $start_date, $exp_date, $voucher_id;
    public $isOpen = 0;

    public function render()
    {
        $this->vouchers = Vouchers::all();
        return view('livewire.voucher-manager');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'code' => 'required',
            'type' => 'required',
            'usage_limits' => 'required',
            'qty' => 'required',
            'min_spend' => 'required',
            'start_date' => 'required',
            'exp_date' => 'required',
        ]);

        $data = [
            'type' => $this->type,
            'usage_limits' => $this->usage_limits,
            'qty' => $this->qty,
            'min_spend' => $this->min_spend,
            'start_date' => $this->start_date,
            'exp_date' => $this->exp_date,
            'web_id' => auth()->user()->id
        ];

        // Cek apakah ada file gambar yang diunggah
        if ($this->image) {
            // Validasi dan simpan file gambar baru
            $this->validate([
                'image' => 'image'
            ]);
            $imagePath = $this->image->store('vouchers', 'public');

            // Hapus foto sebelumnya jika sedang dalam mode update
            if ($this->voucher_id) {
                $existingVoucher = Vouchers::find($this->voucher_id);
                if ($existingVoucher && $existingVoucher->image && Storage::disk('public')->exists($existingVoucher->image)) {
                    Storage::disk('public')->delete($existingVoucher->image);
                }
            }

            $data['image'] = $imagePath;
        }

        // Simpan data ke dalam database
        Vouchers::updateOrCreate(['code' => $this->code], $data);

        session()->flash('message',
            $this->voucher_id ? 'Voucher updated successfully.' : 'Voucher created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }




    public function edit($id)
    {
        $voucher = Vouchers::findOrFail($id);
        $this->voucher_id = $id;
        $this->code = $voucher->code;
        $this->type = $voucher->type;
        $this->usage_limits = $voucher->usage_limits;
        $this->qty = $voucher->qty;
        $this->min_spend = $voucher->min_spend;
        $this->start_date = $voucher->start_date;
        $this->exp_date = $voucher->exp_date;

        $this->openModal();
    }

    public function delete($id)
    {
        $voucher = Vouchers::find($id);
        if ($voucher) {
            // Hapus foto terkait dari storage
            if (Storage::disk('public')->exists($voucher->image)) {
                Storage::disk('public')->delete($voucher->image);
            }

            // Hapus entitas Vouchers
            $voucher->delete();

            session()->flash('message', 'Voucher deleted successfully.');
        }
    }


    private function resetInputFields()
    {
        $this->code = '';
        $this->type = '';
        $this->usage_limits = '';
        $this->qty = '';
        $this->min_spend = '';
        $this->start_date = '';
        $this->exp_date = '';
        $this->voucher_id = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
