<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Pegawai extends Model
{

    public $table = 'pegawai';
    


    public $fillable = [
        'nip',
        'nama',
        'pangkat',
        'golongan',
        'jabatan',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nip' => 'integer',
        'nama' => 'string',
        'pangkat' => 'string',
        'golongan' => 'string',
        'jabatan' => 'string',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nip' => 'required|integer',
        'nama' => 'required',
        'pangkat' => 'required',
        'golongan' => 'required',
        'jabatan' => 'required'
    ];
}
