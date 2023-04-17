<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Basan extends Model
{
    use HasFactory, Uuids;

    protected $table = 'basans';
    protected $fillable = [
        'penelitian_id',
        'no',
        'nama',
        'photo',
        'keterangan',
        'jumlah',
        'golongan',
        'kondisi',
        'kondisi',
        'bentuk',
        'berat',
        'tinggi',
        'ciri',
        'sifat',
        'keadaan',
        'status'
    ];
}
