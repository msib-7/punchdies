<?php

namespace App\Http\Controllers;

use App\Models\Lines;
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
        $dataLines = Lines::orderBy('nama_line', 'asc')->get();
        $data['dataUser'] = $dataUser;
        $data['dataRoles'] = $dataRoles;
        $data['dataLines'] = $dataLines;
        return view("admin/manajemen-user/data-user", $data);
    }
    public function add_user(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $username = ucwords($request->username);
        $password = $request->password;
        $role = $request->user_role;
        $line = $request->line_id;
        $cekUsername = User::where('username', '=', $username)->first();
        if (!$cekUsername) {
            $saveUser = [
                'nama' => $nama,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role_id' => $role,
                'line_id' => $line,
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
        $nama = $request->nama_edit;
        $email = $request->email_edit;
        $role = $request->user_role_edit;
        $line = $request->line_id_edit;
        $dataUpdate = [
            'nama' => $nama,
            'email' => $email,
            'role_id' => $role,
            'line_id' => $line,
        ];
        User::where('username', '=', $usn)->update($dataUpdate);
        return redirect(route('user'))->with('success', 'User berhasil diUpdate!');
    }
}
