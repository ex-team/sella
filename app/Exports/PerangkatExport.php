<?php

namespace App\Exports;

use App\Models\Perangkat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class PerangkatExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $data = Pegawai::query()->select(['id_perangkat', 'uraian_perangkat', 'stok_perangkat', 'tahun_pengadaan_perangkat', 'type_perangkat']);

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID Perangkat',
            'Uraian Perangkat',
            'Stok Perangkat',
            'Tahun Pengadaan Perangkat',
            'Type Perangkat',
        ];
    }
}
