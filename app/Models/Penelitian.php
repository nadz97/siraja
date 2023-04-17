<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penelitian extends Model
{
    use HasFactory, Uuids;

    protected $table = 'penelitians';
    protected $fillable = [
        'tanggal',
        'no_penelitian',
        'no_registrasi_perkara',
        'no_registrasi_bb',
        'surat_perintah',
        'tanggal_sp',
        'pasal',
        'terdakwa_id',
        'keterangan_terdakwa',
        'jaksa1',
        'jaksa2',
        'saksi1',
        'saksi2',
        'penyidik',
        'kasi_bb',
        'petugas',
        'penyerah',
        'peneliti_sk',
        'peneliti1',
        'peneliti2',
        'peneliti3',
        'kepala_rupbasan',
    ];
}
