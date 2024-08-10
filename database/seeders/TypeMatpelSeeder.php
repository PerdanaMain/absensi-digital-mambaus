<?php

namespace Database\Seeders;

use App\Models\TypeMatpel;
use Illuminate\Database\Seeder;

class TypeMatpelSeeder extends Seeder
{
    public function run(): void
    {
        TypeMatpel::insert([
            [
                "name" => "Sekolah",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Madin",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}