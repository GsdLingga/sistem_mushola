<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'telepon' => $faker->phoneNumber,
            'slug' => 'Admin',
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Pengurus',
            'email' => 'pengurus@gmail.com',
            'password' => bcrypt('pengurus123'),
            'telepon' => $faker->phoneNumber,
            'slug' => 'Pengurus',
            'role' => 'Pengurus',
        ]);

        User::create([
            'name' => 'Guru',
            'email' => 'guru@gmail.com',
            'password' => bcrypt('guru123'),
            'telepon' => $faker->phoneNumber,
            'slug' => 'Guru',
            'role' => 'Guru',
        ]);
    }
}
