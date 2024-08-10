<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SantriSecondExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $data = $this->data;
        $data = $data->map(function ($item) {
            return [
                'ID Santri' => $item->santriId,
                'Nama' => $item->name,
                'Umur' => $item->age,
                "TTL" => $item->birth_place . ", " . $item->birth_date,
                "Alamat" => $item->address,
                'Nama Wali' => $item->wali->name,
                'Nama Pengurus' => $item->pengurus->name,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID Santri',
            'Nama',
            'Umur',
            "TTL",
            "Alamat",
            'Nama Wali',
            'Nama Pengurus',
        ];
    }
}
