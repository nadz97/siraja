<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory, Uuids;

    protected $table = 'pegawais';

    protected $fillable = ['user_id', 'instansi_id' , 'nip' , 'jabatan_id' , 'pangkat' , 'alamat' , 'no_ktp' , 'photo' , 'biodata'];
}
