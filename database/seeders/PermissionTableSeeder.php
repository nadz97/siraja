<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'instansi-list',
            'instansi-create',
            'instansi-edit',
            'instansi-delete',

            'pegawai-list',
            'pegawai-create',
            'pegawai-edit',
            'pegawai-delete',

            'peneliti-list',
            'peneliti-create',
            'peneliti-edit',
            'peneliti-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'id' => Str::uuid()->toString(),
                'name' => $permission
            ]);
        }
    }
}
