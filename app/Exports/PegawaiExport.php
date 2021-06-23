<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class PegawaiExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $data = Pegawai::query()->select(['nip', 'nama', 'pangkat', 'golongan', 'jabatan', 'foto']);

        return $data;
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Pangkat',
            'Golongan',
            'Jabatan',
            'Foto',
        ];
    }
}
