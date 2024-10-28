<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class Users extends Controller
{
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
        $cekUsername = User::where('username', '=', $username)->first();
        if (!$cekUsername) {
            $saveUser = [
                'username' => $username,
                'password' => $password,
                'role_id' => $role,
                'last_login_at' => null,
            ];
            User::create($saveUser);
            return redirect(route('user'))->with('success', 'User ' . $username . ' berhasil dibuat!');
        } else {
            return redirect(route('user'))->with('error', 'Username sudah ada!');
        }
    }
    public function edit_user(Request $request, $usn)
    {
        $data = User::where('username', '=', $usn)->first();
        $request->session()->put('usn', $usn);
        return response()->json([
            'success' => true,
            'message' => 'User Data',
            'data' => $data
        ]);
    }
    public function update_user(Request $request)
    {
        $usn = session()->get('usn');
        $user_role = ucwords($request->user_role_edit);
        $dataUpdate = [
            'role_id' => $user_role,
        ];
        User::where('username', '=', $usn)->update($dataUpdate);
        return redirect(route('user'))->with('success', 'User berhasil diUpdate!');
    }
}
