<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use App\Models\Roles;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Log;
use Validator;

class Users extends Controller
{
    //Start User
    public function manajemen_user()
    {
        $modelUser = new User();
        // $dataUser = User::all();
        // $dataUser = $modelUser->getUserRole()->all();
        $dataUser = User::with('roles')->get();
        $dataRoles = Roles::orderBy('role_name', 'asc')->get();
        $dataLines = Lines::orderBy('nama_line', 'asc')->get();
        $data['dataUser'] = $dataUser;
        $data['dataRoles'] = $dataRoles;
        $data['dataLines'] = $dataLines;
        return view("admin/manajemen-user/data-user", $data);
    }
    public function add_user(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'email' => 'required',
        //     'username' => 'required',
        //     'password' => 'required',
        //     'role' => 'required',
        //     'line' => 'required',
        // ]);

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'user_role' => 'required',
            'line_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.users.index'))->with('error', 'Field cannot be empty!');
        } else {
            $nama = $request->nama;
            $email = $request->email;
            $username = $request->username;
            $password = $request->password;
            $role = $request->user_role;
            $line = $request->line_id;

            $cekUsername = User::where('username', '=', $username)->exists();

            if (!$cekUsername) {
                try {
                    DB::beginTransaction();

                    User::create([
                        'nama' => $nama,
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'role_id' => $role,
                        'line_id' => $line,
                        'last_login_at' => null,
                    ]);

                    DB::commit();

                    return redirect(route('admin.users.index'))->with('success', 'User ' . $username . ' berhasil dibuat!');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    // Log error untuk debugging
                    Log::error('Error Create User : ' . $th->getMessage());

                    return redirect(route('admin.users.index'))->with('error', 'something went wrong!');
                }
            } else {
                return redirect(route('admin.users.index'))->with('error', 'Username sudah ada!');
            }
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
        return redirect(route('admin.users.index'))->with('success', 'User berhasil diUpdate!');
    }
    public function delete_user($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect(route('admin.users.index'))->with('error', 'User not found!');
        }
        User::where('id',  $id)->delete();
        return redirect(route('admin.users.index'))->with('success', 'User deleted successfully');
    }
}
