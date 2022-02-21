<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;;

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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Pengurus',
            'email' => 'pengurus@gmail.com',
            'password' => bcrypt('pengurus123'),
            'role' => 'Pengurus',
        ]);

        User::create([
            'name' => 'Guru',
            'email' => 'guru@gmail.com',
            'password' => bcrypt('guru123'),
            'role' => 'Guru',
        ]);
    }
}
