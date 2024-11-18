<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::create([
            'avatar' => 'https://picsum.photos/100?random=1', // URL gambar avatar acak
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Password default di-hash
            'role' => 'admin', // Role default
        ]);

        foreach (range(1, 1000) as $index) {
            User::create([
                'avatar' => 'https://picsum.photos/100?random=' . $index, // URL gambar avatar acak
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Password default di-hash
                'role' => 'user', // Role default
            ]);
        }
    }
}
