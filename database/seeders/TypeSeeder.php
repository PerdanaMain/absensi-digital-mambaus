<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{

    public function run(): void
    {
        Type::insert([
            [
                'name' => 'Umum',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Madin',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Mandiri',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}