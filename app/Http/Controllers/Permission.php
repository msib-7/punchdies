<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Http\Request;

class Permission extends Controller
{
    //Start Permission
    public function manajemen_permission()
    {
        $modelRole = new Roles();

        $dataAssigned = $modelRole->getRoleJoinPermission()->all();
        $data['dataAssigned'] = $dataAssigned;

        $getDataPermission = Permissions::count();
        if ($getDataPermission == 0) {
            $dataPermission = [];
        } else {
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

        $permission_name = ucwords($request->permission_name);

        $autoIncrement = Permissions::select('id')->orderBy('id', 'desc')->limit(1)->first();
        if(!$autoIncrement){
            $saveData = [
                'id' => 1,
                'name' => $permission_name,
            ];
        }else{
            $saveData = [
                'id' => $autoIncrement->id + 1,
                'name' => $permission_name,
            ];
        }

        $cekPermission = Permissions::whereLike('name', '%' . $permission_name . '%')->first();
        if (!isset($cekPermission)) {
            Permissions::create($saveData);
            return redirect(route('permissions'))->with('success', 'New Permission has been added!');
        } else {
            return redirect(route('permissions'))->with('error', 'Permission sudah ada!');
        }

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
        $permission_name = ucwords($request->permission_name_edit);

        $autoIncrement = Permissions::select('id')->orderBy('id', 'desc')->limit(1)->first();
        $dataUpdate = [
            'name' => $permission_name,
        ];

        $cekPermission = Permissions::whereLike('name', '%' . $permission_name . '%')->first();
        // dd(isset($cekPermission));
        if (!isset($cekPermission)) {
            Permissions::where('id', '=', $id)->update($dataUpdate);
            return redirect(route('permissions'))->with('success', 'Permission berhasil diUpdate!');
        } else {
            return redirect(route('permissions'))->with('error', 'Permission sudah ada!');
        }
    }
    public function del_permission($id)
    {
        Permissions::where('id', '=', $id)->delete();
        return redirect(route('permissions'))->with('success', 'Permission has been deleted!');
    }
}
