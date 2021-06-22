<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Peminjaman extends Model
{

    public $table = 'peminjaman';
    


    public $fillable = [
        'id_perangkat',
        'tgl_peminjaman',
        'tgl_pengembalian',
        'keperluan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'keperluan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_perangkat' => 'required|integer',
        'tgl_peminjaman' => 'required|date',
        'tgl_pengembalian' => 'required|date'
    ];
}
