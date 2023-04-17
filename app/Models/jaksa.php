<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jaksa extends Model
{
    use HasFactory, Uuids;

    protected $table = 'jaksas';
    protected $fillable = [
        'name',
        'NIP',
        'instansi_id',
        'jabatan_id',
        'pangkat',
        'alamat',
        'no_ktp',
        'photo',
        'biodata'
    ];
}
