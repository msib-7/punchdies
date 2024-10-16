<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
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
        $dataPermissions = Permissions::all();
        $permissions_by_group = [];
        foreach ($dataPermissions ?? [] as $permission) {
            $ability = Str::after($permission->name, ' ');
            $permissions_by_group[$ability][] = $permission;
        }

        // dd(compact('permissions_by_group'));

        return view("admin/manajemen-role/data-role", compact('permissions_by_group'));
    }

}
