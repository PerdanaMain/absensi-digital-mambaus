<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SantriExport implements FromCollection, WithHeadings
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
                "Nama Matpel" => $item->matpel->name . " - " . $item->matpel->kelas->name,
                "Tipe Matpel" => $item->matpel->type->name,
                "ID Santri" => $item->santriId,
                "Nama Santri" => $item->santri->name,
            ];
        });
        return $data;
    }

    public function headings(): array
    {
        return [
            'ID Matpel',
            'Nama Matpel',
            'Tipe Matpel',
            'ID Santri',
            'Nama Santri',
        ];
    }
}
