<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::insert([
            [
                "username" => "admin",
                "password" => Hash::make("admin"),
                "image" => null,
                "roleId" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ], [
                "username" => "walisantri1",
                "password" => Hash::make("12345"),
                "image" => null,
                "roleId" => 4,
                "created_at" => now(),
                "updated_at" => now(),
            ], [
                "username" => "gurumapel1",
                "password" => Hash::make("12345"),
                "image" => null,
                "roleId" => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}