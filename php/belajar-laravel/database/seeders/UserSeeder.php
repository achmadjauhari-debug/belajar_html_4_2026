<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // User Model sudah ada by default

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //eloquent -> ORM di Laravel
        User::create([
            'name'=>'Admin',
            'email'=> 'admin@gmail.com',
            'password'=> 12345678
        ]);
    }
}
