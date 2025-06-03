<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run()
{
    if (!Guru::where('username', 'andika')->exists()) {
        Guru::create([
            'username' => 'andika',
              ['password' => '12345678']
        ]);
    }
}
}
