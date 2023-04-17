<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instansi extends Model
{
    use HasFactory, Uuids;

    protected $table = 'Instansis';
    protected $fillable = [
        'name',
        'alamat',
        'logo',
        'telp',
        'email',
        'keterangan'
    ];
}
