<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory, Uuids;
    protected $table = "jabatans";
    protected $fillable = ["jabatan", "keterangan"];
}
