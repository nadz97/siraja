<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. simpan ke tabel "instansis"
        $instansi_id = Str::uuid()->toString();
        $instansi = DB::table('instansis')->insert([
            'id' => $instansi_id,
            'nama' => 'Gadungan',
            'alamat' => 'Jl Pluit Raya 32 AC, Dki Jakarta',
            'telp' => '0818181818',
            'email' => 'gadungan@gmail.com'
        ]);

        // 1. simpan ke tabel "instansis"
        $instansi_id = Str::uuid()->toString();
        $instansi = DB::table('instansis')->insert([
            'id' => $instansi_id,
            'nama' => 'Poltek',
            'alamat' => 'Jl Dr Saharjo 90, Dki Jakarta',
            'telp' => '123123123',
            'email' => 'poltek@gmail.com'
        ]);

        // 2. simpan ke table "users"
        $user_id = Str::uuid()->toString();
        $user = DB::table("users")->insert([
            "id" => $user_id,
            "name" => 'foxtrot',
            "email" => 'foxtrot@gmail.com',
            "password" => bcrypt('123456')
        ]);

        // 3. Simpan ke table "jabatans"
        $jabatan_id = Str::uuid()->toString();
        $jabatan = DB::table('jabatans')->insert([
            "id" => $jabatan_id,
            "jabatan" => 'Kepala Rumah Sakit Umum',
            "keterangan" => 'Tidak ada'
        ]);

        // 4. simpan ke tabel "pegawais"
        $pegawai_id = Str::uuid()->toString();
        $pegawai = DB::table("pegawais")->insert([
            "id" => $pegawai_id,
            "user_id" => $user_id,
            "instansi_id" => $instansi_id,
            "nip" => '1239019204',
            "jabatan_id" => $jabatan_id,
            "pangkat" => 'Sgt.',
            "alamat" => 'Jln.tikus rumah',
            "no_ktp" => '123455655',
            "photo" => '',
            "biodata" => 'Lorem ipsum dolor sit amet.'
        ]);
    }
}
