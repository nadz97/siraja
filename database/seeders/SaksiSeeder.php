<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Saksi;
use App\Models\Jabatan;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan_id = Str::uuid()->toString();
        $jabatan = Jabatan::create([
            "id" => $jabatan_id,
            "jabatan" => "Saksi",
            "keterangan" => "tidak ada"
        ]);

        $id_saksi = Str::uuid()->toString();

        $saksi = Saksi::create([
            "id" => $id_saksi,
            "name" => 'danu',
            "nip" => "7464384343639",
            "jabatan_id" => $jabatan->id,
            "pangkat" => "4F",
            "alamat" => "Lorem ipsum dolor sit amet.",
            "no_ktp" => "091273097204",
            "biodata" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, facere."
        ]);
    }
}
