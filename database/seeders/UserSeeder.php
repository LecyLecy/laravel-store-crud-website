<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'full_name' => 'Saladin Zhalifunnas Ahfar',
            'admin_id' => '1',
            'email' => 'ok@gmail.com',
            'password' => bcrypt('123456'),
            'number' => '0811181063',
            'role' => 'admin',
        ]);
    }
}
