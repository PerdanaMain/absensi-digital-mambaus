<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        Status::insert([
            [
                "name" => "Hadir",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Izin",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Sakit",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Tidak Hadir",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Disetujui",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name" => "Ditolak",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
