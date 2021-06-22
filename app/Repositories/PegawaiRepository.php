<?php

namespace App\Repositories;

use App\Models\Pegawai;
use InfyOm\Generator\Common\BaseRepository;

class PegawaiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pegawai::class;
    }
}
