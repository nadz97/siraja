<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = Str::uuid()->toString();
        $jabatan = Jabatan::create([
            "id" => $id,
            "jabatan" => "Penyerah",
            "keterangan" => "tidak ada"
        ]);

        $jabatan = Jabatan::create([
            "id" => $id,
            "jabatan" => "Petugas Basan",
            "keterangan" => "tidak ada"
        ]);



        $jabatan = Jabatan::create([
            "id" => $id,
            "jabatan" => "Kasi BB",
            "keterangan" => "tidak ada"
        ]);

        $jabatan = Jabatan::create([
            "id" => $id,
            "jabatan" => "Penyidik",
            "keterangan" => "tidak ada"
        ]);

        $jabatan = Jabatan::create([
            "id" => $id,
            "jabatan" => "Peneliti",
            "keterangan" => "tidak ada"
        ]);

        $jabatan = Jabatan::create([
            "id" => $id,
            "jabatan" => "Kepala Rupbasan",
            "keterangan" => "tidak ada"
        ]);
    }
}
