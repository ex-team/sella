<?php

namespace App\Repositories;

use App\Models\Peminjaman;
use InfyOm\Generator\Common\BaseRepository;

class PeminjamanRepository extends BaseRepository
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
        return Peminjaman::class;
    }
}
