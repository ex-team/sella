<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Perangkat extends Model
{

    public $table = 'perangkat';
    


    public $fillable = [
        'id_perangkat',
        'uraian_perangkat',
        'stok_perangkat',
        'tahun_pengadaan_perangkat',
        'type_perangkat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_perangkat' => 'integer',
        'uraian_perangkat' => 'string',
        'stok_perangkat' => 'integer',
        'type_perangkat' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_perangkat' => 'required|integer'
    ];
}
