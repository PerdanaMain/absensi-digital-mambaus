<?php

namespace Database\Seeders;

use App\Models\Matpel;
use Illuminate\Database\Seeder;

class MatpelSeeder extends Seeder
{
    public function run(): void
    {
        Matpel::insert([
            [
                "name" => "Matematika",
                "typeMatpelId" => 1,
                "kelasId" => rand(1, 7),
                "guruId" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Bahasa Indonesia",
                "typeMatpelId" => 1,
                "kelasId" => rand(1, 7),
                "guruId" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Bahasa Arab",
                "typeMatpelId" => 2,
                "kelasId" => rand(1, 7),
                "guruId" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Fiqih",
                "typeMatpelId" => 2,
                "kelasId" => rand(1, 7),
                "guruId" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Kimia",
                "typeMatpelId" => 1,
                "kelasId" => rand(1, 7),
                "guruId" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Fisika",
                "typeMatpelId" => 1,
                "kelasId" => rand(1, 7),
                "guruId" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}