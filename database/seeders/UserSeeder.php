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
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '08561276261',
            'address' => 'Cicurug'
        ]);

        User::create([
            'username' => 'petugas',
            'password' => bcrypt('petugas123'),
            'role' => 'petugas',
            'phone' => '08561276890',
            'address' => 'Cidengdeng'
        ]);
    }
}
