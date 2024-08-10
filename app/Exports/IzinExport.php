<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IzinExport implements FromCollection, WithHeadings
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
                "Nama Santri" => $item->santri->name,
                "Alasan Izin" => $item->description,
                "Tanggal Keluar" => $item->tglKeluar,
                "Tanggal Kembali" => $item->tglKembali,
                "Status" => $item->isComback ? "Sudah Kembali" : "Belum Kembali",
                "Nama Pengurus" => $item->santri->pengurus->name,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            "Nama Santri",
            "Alasan Izin",
            "Tanggal Keluar",
            "Tanggal Kembali",
            "Status",
            "Nama Pengurus",
        ];
    }
}