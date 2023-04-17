<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */


    public function index(Request $request)
    {
        $roles = DB::table('roles')->orderBy('name', 'ASC')->paginate(5);
        return view('home.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function search(Request $request)
    {

        $roles = DB::table('roles')
            ->where('name', $request->name)
            ->paginate(5);

        return view('home.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $permission = DB::table('permissions')->get();

        return view('home.roles.create', compact('permission'));
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role_id = Str::uuid()->toString();
        $role = (string)DB::table('roles')->insertGetId(
            [
                'id' => $role_id,
                'guard_name' => 'web',
                'name' => $request->input('name')
            ]
        );

        // 2.Simpan ke tabel "role_has_permission"
        foreach ($request->permission as $pms) {
            $rhp = DB::table('role_has_permissions')->insert([
                'permission_id' => $pms,
                'role_id' => $role_id
            ]);
        }



        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($uuid)

    {

        $role = DB::table('roles', $uuid)->get();

        $rolePermissions = DB::table('permissions AS pms')
            ->join('role_has_permissions AS rhp', 'rhp.permission_id', '=', 'pms.id')
            ->where('rhp.role_id', $uuid)
            ->get();

        return view('home.roles.show', compact('role', 'rolePermissions'));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $role = DB::table('roles')->where('id', '=', $id)->first();
        $permission = DB::table('permissions')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        // return response()->json($role);
        return view('home.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        // $role = Role::find($id);
        // $role->name = $request->input('name');
        // $role->save();

        // $role->syncPermissions($request->input('permission'));

        // 1. simpan ke tabel "roles" sesuai ID
        $role = DB::table('roles')->where('id', $id)->update([
            'name' => $request->input('name')
        ]);

        // 2. hapus semua data dari tabel "role_has_permisssions" berdasarkan "id"
        $hapus = DB::table('role_has_permissions')->where('role_id', $id)->delete();

        foreach ($request->permission as $pms) {
            $rhp = DB::table('role_has_permissions')->insert([
                'permission_id' => $pms,
                'role_id' => $id
            ]);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        DB::table("roles")->where('id', $id)->delete();

        return redirect()->route('roles.index')

            ->with('success', 'Role deleted successfully');
    }
}
