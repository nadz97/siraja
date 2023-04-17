<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saksi extends Model
{
    use HasFactory;

    protected $table = 'saksis';
    protected $fillable = ['name', 'jabatan_id' , 'nip', 'pangkat' , 'alamat' , 'no_ktp' , 'photo' , 'biodata'];
}
