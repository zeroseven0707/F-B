<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name'=>'Hallo Beauty',
            'email'=>'hallo@gmail.com',
            'province'=>'Jawabarat',
            'city'=>'Tasikmalaya',
            'district'=>'Singaparna',
            'subdistrict'=>'Singaparna',
            'address'=>'Singaparna, Cipakat, Kec. Singaparna, Kabupaten Tasikmalaya, Jawa Barat 4641',
            'password'=>bcrypt(12345678),
            'api_key'=>'kjshdkisjodiweoijfeowijforei',
            'url_web'=>'https://hallobeauty.shop',
            'level'=>'bisnis'
        ]);
        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'province'=>'Jawabarat',
            'city'=>'Tasikmalaya',
            'district'=>'Singaparna',
            'subdistrict'=>'Singaparna',
            'address'=>'Singaparna, Cipakat, Kec. Singaparna, Kabupaten Tasikmalaya, Jawa Barat 4641',
            'password'=>bcrypt(12345678),
            'api_key'=>'0',
            'url_web'=>'',
            'level'=>'superadmin'
        ]);
    }
}
