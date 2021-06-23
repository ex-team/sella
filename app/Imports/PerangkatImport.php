<?php

namespace App\Imports;

use App\Models\Perangkat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class PerangkatImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows){
        foreach ($rows as $row) {
            $selected_item = Perangkat::where([['id_perangkat' , $row->get('id_perangkat')], ['uraian_perangkat' , $row->get('uraian_perangkat')]])->first();
            if ($selected_item) {
                $item = $selected_item->update(
                    [
                        'id_perangkat'                  => $row->get('id_perangkat'),
                        'uraian_perangkat'              => $row->get('uraian_perangkat'),
                        'stok_perangkat'                => $row->get('stok_perangkat'),
                        'tahun_pengadaan_perangkat'     => $row->get('tahun_pengadaan_perangkat'),
                        'type_perangkat'                => $row->get('type_perangkat'),
                        'updated_at'                    => date('Y-m-d H:i:s')
                    ]
                );
            } else {
                $item = Perangkat::create(
                    [
                        'id_perangkat'                  => $row->get('id_perangkat'),
                        'uraian_perangkat'              => $row->get('uraian_perangkat'),
                        'stok_perangkat'                => $row->get('stok_perangkat'),
                        'tahun_pengadaan_perangkat'     => $row->get('tahun_pengadaan_perangkat'),
                        'type_perangkat'                => $row->get('type_perangkat'),
                        'created_at'                    => date('Y-m-d H:i:s'),
                        'updated_at'                    => date('Y-m-d H:i:s')
                    ]
                );
            }
        }
    }
}
