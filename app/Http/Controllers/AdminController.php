<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use App\Models\RolesPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Str;
use Validator;

use function PHPUnit\Framework\isNull;

class AdminController extends Controller
{
    public function mount()
    {
        // Get all permissions.
        $this->permissions = Permissions::all();

        // Set the checked permissions property to an empty array.
        $this->checked_permissions = [];
    }
    public function dashboard()
    {
        return view("admin.dashboard");
    }

    //Start User
    public function manajemen_user()
    {
        $dataUser = User::all();

        $data['dataUser'] = $dataUser;
        return view("admin/manajemen-user/data-user", $data);
    }
    public function add_user(Request $request)
    {
        $username = $request->username;
        $password = $request->password;


    }

    //Start Role
    public function manajemen_role()
    {
        $modelRole = new Roles();

        $dataRoles = Roles::all();
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

        $cekRole = Roles::whereLike('role_name', $role_name )->first();
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

        if($permission_value != ''){
            $count = count($permission_value);
            for ($i=0; $i < $count; $i++) { 
                $saveRolePermission = [
                    'permission_id' => $permission_value[$i],
                    'role_id' => $role_id,
                ];
                RolesPermission::create($saveRolePermission);
            }
        }

        return redirect(route('roles'))->with('success', 'Role berhasil diBuat!');
    }
}
