<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{

    public function run(): void
    {
        Kelas::insert(
            [
                [
                    "name" => "Mts - 7",
                    "created_at" => now(),
                    "updated_at" => now(),
                    "deleted_at" => null
                ],
                [
                    "name" => "Mts - 8",
                    "created_at" => now(),
                    "updated_at" => now(),
                    "deleted_at" => null
                ],
                [
                    "name" => "Mts - 9",
                    "created_at" => now(),
                    "updated_at" => now(),
                    "deleted_at" => null
                ],
                [
                    "name" => "MA - 10",
                    "created_at" => now(),
                    "updated_at" => now(),
                    "deleted_at" => null
                ],
                [
                    "name" => "MA - 11",
                    "created_at" => now(),
                    "updated_at" => now(),
                    "deleted_at" => null
                ],
                [
                    "name" => "MA - 12",
                    "created_at" => now(),
                    "updated_at" => now(),
                    "deleted_at" => null
                ],
                [
                    "name" => "Ma'had Aly",
                    "created_at" => now(),
                    "updated_at" => now(),
                    "deleted_at" => null
                ],
            ]
        );
    }
}