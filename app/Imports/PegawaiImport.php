<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class PegawaiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows){
        foreach ($rows as $row) {
            $selected_user = Pegawai::where('nip' , $row->get('nip'))->first();
            if ($selected_user) {
                $user = $selected_user->update(
                    [
                        'nip'          => $row->get('nip'),
                        'nama'         => $row->get('nama'),
                        'pangkat'      => $row->get('pangkat'),
                        'golongan'     => $row->get('golongan'),
                        'jabatan'      => $row->get('jabatan'),
                        'updated_at'   => date('Y-m-d H:i:s')
                    ]
                );
            } else {
                $user = Pegawai::create(
                    [
                        'nip'          => $row->get('nip'),
                        'nama'         => $row->get('nama'),
                        'pangkat'      => $row->get('pangkat'),
                        'golongan'     => $row->get('golongan'),
                        'jabatan'      => $row->get('jabatan'),
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s')
                    ]
                );
            }
        }
    }
}
