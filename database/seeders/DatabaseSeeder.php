<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Abdul Malik Muzakir',
            'username'=> 'admin55',
            'email' => 'abdulmalikmuzakir55@gmail.com',
            'password' => Hash::make('password'),
            'level' => 'admin'
        ]);
    }
}