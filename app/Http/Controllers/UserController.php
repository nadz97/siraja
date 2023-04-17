<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {

        // $data = User::all();
        $data = User::orderBy('name', 'ASC')->paginate(5);

        // // return response()->json($data);
        return view('home.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

        // $page = $request->input('page', 1);
        // $perPage = 5;
        // $offset = ($page - 1) * $perPage;

        // $data = User::orderBy('name', 'ASC')
        //     ->offset($offset)
        //     ->limit($perPage)
        //     ->get()
        //     ->map(function ($user) {
        //         $user->roles = implode(', ', $user->getRoleNames()->toArray());
        //         return $user;
        //     });

        // $totalusers = User::count();
        // $totalPages = ceil($totalusers / $perPage);

        // return view('home.users.index', compact('data', 'totalPages', 'page'));
    }

    public function search(Request $request)
    {

        $data = User::where('name', $request->name)->paginate(5);


        return view('home.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('home.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // $role_id = DB::table('roles')->where('name', '=', $request->roles)->value('id');

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $model_id = $user->id;

        $selectedRoleIds = $request->input('roles');

        // simmpan ke tabel "model_has_roles"
        foreach ($selectedRoleIds as $selectedRoleId) {

            DB::table('model_has_roles')->insert([
                'role_id' => $selectedRoleId,
                'model_type' => get_class($user),
                'model_id' => $model_id
            ]);
        }
        // ambil kolom "id" dari table "roles"  dengan kriteria  kolom "name" dari input
        $id_rl = DB::table("roles")->where("name", $request->roles)->value("id");

        //cari dari table "role_has_permissions" dengan kriteria kolom "role_id" = $id_rl
        $permissions =  DB::table("role_has_permissions")->where("role_id", $id_rl)->select("permission_id")->get();

        $user_id = Auth::id();
        // 3. simpan ke tabel "model_has_permissions"
        foreach ($permissions as $p) {
            $rhp = DB::table("model_has_permissions")->insert([
                "permission_id" => $p->permission_id,
                "model_type" => "App\Models\User",
                "model_id" => $user_id

            ]);
        }
        // $user->assignRole($request->input('roles'));

        return redirect()->route('home.users.index')
            ->with('success', 'User created successfully');
    }

    public function show($uuid)
    {
        $user = User::find($uuid);
        // dd($user);
        return view('home.users.show', compact('user'));
    }

    public function edit($id)
    {
        // $user = User::find($id);
        // $roles = Role::pluck('name', 'name')->all();
        // $userRole = $user->roles->pluck('name', 'name')->all();
        // return view('home.users.edit', compact('user', 'roles', 'userRole'));

        $user = User::find($id);
        if ($user) {
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();

            return view('home.users.edit', compact('user', 'roles', 'userRole'));
        } else {
            // handle the case where the user was not found
            return redirect()->route('users.index')
                ->with('error', 'User not found');
        }
    }

    public function update(Request $request, $id)
    {
        $role_id = DB::table('roles')->where('name', '=', $request->roles)->value('id');

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        $model_id = $user->id;

        $mrhs = DB::table('model_has_roles')->where('model_id', $id)->get();
        if ($mrhs->count() > 0) {
            $mrhs->delete();
        }

        $mhr = DB::table('model_has_roles')->insert([
            'role_id' => $role_id,
            'model_type' => 'App\Models\User',
            'model_id' => $model_id
        ]);
        // $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
