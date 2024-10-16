<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
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
        $dataUser = User::all();

        $data['dataUser'] = $dataUser;
        return view("admin/manajemen-role/data-role", $data);
    }


    //Start Permission
    public function manajemen_permission()
    {
        $getDataPermission = Permissions::count();
        if($getDataPermission == 0){
            $dataPermission = [];
        }else {
            $dataPermission = Permissions::all();
        }

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
    public function edit_permission(Request $request, $id)
    {
        $data = Permissions::where('id', '=', $id)->first();
        $request->session()->put('id', $id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data' => $data
        ]);
    }
    public function update_permission(Request $request)
    {
        $id = session()->get('id');
        $permission_name = $request->permission_name_edit;

        $dataUpdate = [
            'name' => $permission_name,
        ];
        $cekPermission = Permissions::where('name', '%LIKE%', $permission_name)->orderBy('name')->get();
        // dd($cekPermission);
        if ($cekPermission['name'] !== $permission_name) {
            Permissions::where('id', '=', $id)->update($dataUpdate);
            return redirect(route('permissions'))->with('success','Permission berhasil diUpdate!');
        }else{
            return redirect(route('permissions'))->with('error', 'Permission sudah ada!');
        }
    }
    public function del_permission(Request $request, $id)
    {
        Permissions::where('id', '=',$id)->delete();
        return redirect(route('permissions'))->with('success', 'Permission has been deleted!');
    }
}
