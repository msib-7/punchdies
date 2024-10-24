<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use App\Models\RolesPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Str;

class Role extends Controller
{
    //Start Role
    public function manajemen_role()
    {
        $modelRole = new Roles();

        $dataRoles = Roles::orderBy('role_name', 'asc')->get();
        $data['dataRoles'] = $dataRoles;

        $dataRolePermission = $modelRole->getRoleJoinPermission()->all();
        $data['permissions'] = $dataRolePermission;


        // dd($dataRoles);
        $dataPermissions = Permissions::all();
        $permissions_by_group = [];
        foreach ($dataPermissions ?? [] as $permission) {
            $ability = Str::after($permission->name, ' ');
            $permissions_by_group[$ability][] = $permission;
        }
        $data['permissions_by_group'] = $permissions_by_group;
        // dd(compact('permissions_by_group'));

        return view("admin/manajemen-role/data-role", $data);
    }
    public function add_role(Request $request)
    {
        $role_name = ucwords($request->role_name);
        $permission_value = $request->permission_value;

        $saveRole = [
            'role_name' => $role_name,
        ];

        $cekRole = Roles::whereLike('role_name', $role_name)->first();
        // dd(isset($cekPermission));
        if (!isset($cekRole)) {
            Roles::create($saveRole);
        } else {
            return redirect(route('roles'))->with('error', 'Role sudah ada!');
        }

        $dataRoles = Roles::where('role_name', '=', $role_name)
            ->orderBy('created_at', 'desc')
            ->first();
        $role_id = $dataRoles['id'];

        if ($permission_value != '') {
            $count = count($permission_value);
            for ($i = 0; $i < $count; $i++) {
                $saveRolePermission = [
                    'permission_id' => $permission_value[$i],
                    'role_id' => $role_id,
                ];
                RolesPermission::create($saveRolePermission);
            }
        }

        return redirect(route('roles'))->with('success', 'Role berhasil diBuat!');
    }
    public function view_role($id)
    {
        $modelRole = new Roles();
        $modelUser = new User();

        $dataRolePermission = Roles::where('id', $id)->first();
        $data['roles'] = $dataRolePermission;

        $dataRolePermission = $modelRole->getRoleJoinPermission()->all();
        $data['permissions'] = $dataRolePermission;

        $dataUser = $modelUser->getUserRole(['role_id' => $id])->all();
        $data['dataUser'] = $dataUser;

        $dataPermissions = Permissions::all();
        $permissions_by_group = [];
        foreach ($dataPermissions ?? [] as $permission) {
            $ability = Str::after($permission->name, ' ');
            $permissions_by_group[$ability][] = $permission;
        }
        $data['permissions_by_group'] = $permissions_by_group;

        return view("admin/manajemen-role/view-role", $data);
    }
    public function edit_role(Request $request, $id)
    {
        $data = Roles::where('id', '=', $id)->first();
        $request->session()->put('id', $id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data' => $data
        ]);
    }
    public function update_role(Request $request)
    {
        $id = session()->get('id');
        $role_name = ucwords($request->role_name_edit);
        $permission_value = $request->permission_value;

        if ($permission_value == '') {
            $dataUpdateRole = [
                'role_name' => $role_name,
            ];
            Roles::where('id', '=', $id)->update($dataUpdateRole);
            return redirect(route('roles'))->with('success', 'Role berhasil diUpdate!');
        } else {
            $dataUpdateRole = [
                'role_name' => $role_name,
            ];
            Roles::where('id', '=', $id)->update($dataUpdateRole);

            RolesPermission::where('role_id', '=', $id)->delete();

            $count = count($permission_value);
            for ($i = 0; $i < $count; $i++) {
                $saveRolePermission = [
                    'permission_id' => $permission_value[$i],
                    'role_id' => $id,
                ];
                RolesPermission::create($saveRolePermission);
            }
            return redirect(route('roles'))->with('success', 'Role berhasil diUpdate!');
        }

    }
    public function del_role($id)
    {
        RolesPermission::where('role_id', '=', $id)->delete();
        Roles::where('id', '=', $id)->delete();

        return redirect(route('roles'))->with('success', 'Role has been deleted!');
    }
}
