<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatpelExport implements FromCollection, WithHeadings
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
                "ID Matpel" => $item->matpelId,
                "Nama" => $item->name,
                "Guru" => $item->guru->name,
                "Kelas" => $item->kelas->name,
                "Tipe" => $item->type->name,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID Matpel',
            'Nama',
            'Guru',
            'Kelas',
            'Tipe',
        ];
    }
}
