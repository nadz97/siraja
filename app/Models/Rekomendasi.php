<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rekomendasi extends Model
{
    use HasFactory, Uuids;

    protected $table = "rekomendasis";
    protected $fillable = ["penelitian_id", "rekomendasi"];
}
