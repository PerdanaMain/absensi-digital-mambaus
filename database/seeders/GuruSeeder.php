<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        Guru::insert([
            [
                "name" => "Ustadz Abdul",
                "address" => "Jl. Raya Ciputat",
                "phone" => "08123456789",
                "userId" => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}