<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use DB;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = Str::uuid()->toString();

        $user = DB::table('users')->insert([
            'id' => $user_id,
            'name' => 'nadzar',
            'email' => 'nadzar@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $role_id = Str::uuid()->toString();

        $role = Role::create([
            'id' => $role_id,
            'name' => 'Admin'
        ]);

        $permissions = DB::table('permissions')->get();

        $model = new \App\Models\User;

        foreach ($permissions as $p) {
            $mhp = DB::table('model_has_permissions')->insert([
                'permission_id' => $p->id,
                'model_type' => get_class($model),
                'model_id' => $user_id
            ]);
        }

        $mhr = DB::table('model_has_roles')->insert([
            'role_id' => $role_id,
            'model_type' => get_class($model),
            'model_id' => $user_id
        ]);

        foreach ($permissions as $pms) {
            $permis = DB::table('role_has_permissions')->insert([
                'permission_id' => $pms->id,
                'role_id' => $role_id
            ]);
        }
    }
}
