<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        Role::insert(
            [
                [
                    "name" => "Admin",
                    "created_at" => now(),
                    "updated_at" => now(),
                ], [
                    "name" => "Guru",
                    "created_at" => now(),
                    "updated_at" => now(),
                ], [
                    "name" => "Pengurus",
                    "created_at" => now(),
                    "updated_at" => now(),
                ], [
                    "name" => "Wali Santri",
                    "created_at" => now(),
                    "updated_at" => now(),
                ],
            ]
        );
    }
}