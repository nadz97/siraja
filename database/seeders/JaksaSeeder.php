<?php

namespace Database\Seeders;

use App\Models\jaksa;
use App\Models\Jabatan;
use App\Models\Instansi;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JaksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. jaksa 1
        $instansi_id = Str::uuid()->toString();
        $instansi = Instansi::create([
            'id' => $instansi_id,
            'nama' => 'Kejakasaan',
            'alamat' => 'Jl Pluit Raya 35 AC, Dki Jakarta',
            'telp' => '0818181818',
            'email' => 'kejaksaan@gmail.com'
        ]);

        $jaksa_id = Str::uuid()->toString();
        $jabatan = Jabatan::create([
            "id" => $jaksa_id,
            "jabatan" => "Jaksa",
            "keterangan" => "tidak ada"
        ]);

        $id = Str::uuid()->toString();
        $jaksas = jaksa::create([
            'id' => $id,
            'name' => 'bambang',
            'NIP' => '888333999',
            'instansi_id' => $instansi->id,
            'jabatan_id' => $jabatan->id,
            'pangkat' => 'tidak ada',
            'alamat' => 'tidak ada',
            'no_ktp' => '12312312333',
            'biodata' => 'tidak ada'
        ]);

        // 2. jaksa 2

        $instansi_id = Str::uuid()->toString();
        $instansi = Instansi::create([
            'id' => $instansi_id,
            'nama' => 'Kejakasaan',
            'alamat' => 'Jl Pluit Raya 36 AC, Dki Jakarta',
            'telp' => '08999999',
            'email' => 'kejaksaan2@gmail.com'
        ]);

        $id = Str::uuid()->toString();
        $jaksas = jaksa::create([
            'id' => $id,
            'name' => 'agung',
            'NIP' => '1299912',
            'instansi_id' => $instansi->id,
            'jabatan_id' => $jabatan->id,
            'pangkat' => 'tidak ada',
            'alamat' => 'tidak ada',
            'no_ktp' => '123414141',
            'biodata' => 'tidak ada'
        ]);
    }
}
