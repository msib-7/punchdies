<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view("admin.dashboard");
    }
    public function manajemen_user()
    {
        $dataUser = User::all();

        $data['dataUser'] = $dataUser;
        return view("admin/manajemen-user/data-user", $data);
    }
    public function manajemen_role()
    {
        $dataUser = User::all();

        $data['dataUser'] = $dataUser;
        return view("admin/manajemen-role/data-role", $data);
    }
    public function manajemen_permission()
    {
        $dataPermission = Permissions::all();

        $data['dataPermission'] = $dataPermission;
        return view("admin/manajemen-permission/data-permission", $data);
    }
    public function add_permission(Request $request)
    {
        $request->validate([
            'permission_name' => 'required',
        ], [
            'permission_name.required' => 'Permission Name is required!',
        ]);

        $permission_name = $request->permission_name;

        $saveData = [
            'name' => $permission_name,
        ];

        Permissions::create($saveData);
        return redirect(route('permissions'))->with('success', 'New Permission has been added!');
    }

    public function add_user(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        
    }
}
