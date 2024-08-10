<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
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
                $item->santri->name,
                $item->description != null ? $item->description : $item->matpel->name . " - " . $item->matpel->kelas->name,
                $item->date,
                $item->status->name,
                $item->type->name,
            ];
        });

        return $data;
    }
    public function headings(): array
    {
        return [
            'Nama Santri',
            'Nama Mata Pelajaran',
            'Tanggal',
            'Status',
            'Type',
        ];
    }
}
