<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            "email" => "admin@demo.com"
        ], [
            "name" => "Admin",
            "password" => Hash::make("password"),
        ]);

        User::firstOrCreate([
            "email" => "adam@demo.com"
        ], [
            "name" => "Adam",
            "password" => Hash::make("password"),
        ]);
    }
}
