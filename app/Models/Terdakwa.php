<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terdakwa extends Model
{
    use HasFactory;

    protected $table = "tedrdakwas";
    protected $fillable = [
        "nama",
        "jabatan",
        "pangkat",
        "alamat",
        "no_ktp",
        "photo",
        "biodata"
    ];
}
