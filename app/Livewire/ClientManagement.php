<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class ClientManagement extends Component
{
      public $name, $c_id, $email, $password, $province, $city, $district, $subdistrict, $url, $address;
    public $updateMode = false;

    public function render()
    {
        $client = User::where('level','bisnis')->get();
        return view('livewire.client-management', compact('client'));
    }
    public function create()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'subdistrict' => 'required',
            'address' => 'required',
            'url' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'subdistrict' => $this->subdistrict,
            'address' => $this->address,
            'password' => bcrypt($this->password),
            'url' => $this->url,
            'api_key' => Str::random(40)
        ]);

        session()->flash('message', 'created successfully.');

        $this->reset(['name', 'email', 'password', 'province', 'city', 'district', 'subdistrict', 'address','url']);
    }

    public function edit($id)
    {
        $client = User::findOrFail($id);
        $this->c_id = $id;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->province = $client->province;
        $this->city = $client->city;
        $this->district = $client->district;
        $this->subdistrict = $client->subdistrict;
        $this->address = $client->address;
        $this->password = $client->password;
        $this->url = $client->url;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'subdistrict' => 'required',
            'address' => 'required',
            'url' => 'required',
            'password' => 'required',
        ]);

        $client = User::findOrFail($this->c_id);
        $client->update([
            'name' => $this->name,
            'email' => $this->email,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'subdistrict' => $this->subdistrict,
            'address' => $this->address,
            'url' => $this->url,
            'password' => bcrypt($this->password),
        ]);

        session()->flash('message', 'updated successfully.');

        $this->reset(['name', 'email', 'password','province', 'city', 'district', 'subdistrict', 'address', 'updateMode','url']);
    }

    public function delete($id)
    {
        $banner = User::findOrFail($id);
        if ($banner->status == 'on') {
            User::where('id',$id)->update(['status'=>'off']);
        }else{
            User::where('id',$id)->update(['status'=>'on']);
        }
    }
}
