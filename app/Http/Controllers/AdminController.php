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
        $modelUser = new User();
        // $dataUser = User::all();
        $dataUser = $modelUser->getUserRole()->all();
        $dataRoles = Roles::orderBy('role_name', 'asc')->get();

        $data['dataUser'] = $dataUser;
        $data['dataRoles'] = $dataRoles;
        return view("admin/manajemen-user/data-user", $data);
    }
    public function add_user(Request $request)
    {
        $username = ucwords($request->username);
        $password = $request->password;
        $role = $request->user_role;


        $cekUsername = User::where('username',  '=',$username)->first();
        if(!$cekUsername){
            $saveUser = [
                'username' => $username,
                'password' => $password,
                'role_id' => $role,
                'last_login_at' => null,
            ];
            User::create($saveUser);
            return redirect(route('user'))->with('success', 'User '.$username.' berhasil dibuat!');
        }else{
            return redirect(route('user'))->with('error', 'Username sudah ada!');
        }

        // $cekRole = Roles::whereLike('role_name', $role_name)->first();
        // // dd(isset($cekPermission));
        // if (!isset($cekRole)) {
        //     Roles::create($saveRole);
        // } else {
        //     return redirect(route('roles'))->with('error', 'Role sudah ada!');
        // }

        // $dataRoles = Roles::where('role_name', '=', $role_name)
        //     ->orderBy('created_at', 'desc')
        //     ->first();
        // $role_id = $dataRoles['id'];

        // if ($permission_value != '') {
        //     $count = count($permission_value);
        //     for ($i = 0; $i < $count; $i++) {
        //         $saveRolePermission = [
        //             'permission_id' => $permission_value[$i],
        //             'role_id' => $role_id,
        //         ];
        //         RolesPermission::create($saveRolePermission);
        //     }
        // }
    }
}
