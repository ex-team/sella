<?php

namespace App\Repositories;

use App\Models\Perangkat;
use InfyOm\Generator\Common\BaseRepository;

class PerangkatRepository extends BaseRepository
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
        return Perangkat::class;
    }
}
