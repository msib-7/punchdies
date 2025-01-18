<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use App\Models\User;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function login_auth(Request $request)
    {
        $username = htmlspecialchars($request->username);
        $password = htmlspecialchars($request->password);
        $ip = request()->ip();

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username field is required!',
            'password.required' => 'Password field is required',
        ]);

        $infoLogin = [
            'username' => $username,
            'password' => $password
        ];

        $users = User::where('username', $username)->first();
        if(empty($users)){
            $logData = [
                'model' => null,
                'model_id' => null,
                'user_id' => null,
                'action' => 'Login Auth',
                'location' => $ip,
                'reason' => 'User Tidak Terdaftar '. $username,
                'how' => 'Login',
                'timestamp' => now(),
                'old_data' => $infoLogin,
                'new_data' => null,
            ];
            (new LogService)->handle($logData);

            return response()->json(['error' => 'User tidak terdaftar'], 401);
        }else{
            if (Auth::attempt($infoLogin)) {
                $last_login = [
                    'last_login_at' => date('Y-m-d H:i:s'),
                ];
                User::where('username', $username)->update($last_login);

                $newData = Auth::user();
                $logData = [
                    'model' => null,
                    'model_id' => null,
                    'user_id' => $newData->id,
                    'action' => 'Login Auth',
                    'location' => $ip,
                    'reason' => 'Berhasil Login ' . $newData->nama,
                    'how' => 'Login',
                    'timestamp' => now(),
                    'old_data' => $infoLogin,
                    'new_data' => $newData,
                ];
                (new LogService)->handle($logData);

                $user = User::where('username', '=', $username)->first();
                $line = Lines::where(['id' => $user->line_id])->first();
                $dataUser = [
                    'user_id' => $user->id,
                    'line_user' => $line->nama_line,
                    'nama_user' => $user->nama,
                    'email_user' => $user->email,
                ];
                session()->put($infoLogin);
                session()->put($dataUser);
                return redirect(route('dashboard'))->with('success', 'Login Berhasil!');
            } else {
                return response()->json(['error' => 'Username dan Password tidak cocok!'], 401);
            }
        }
    }

    public function logout(Request $request)
    {
        $ip = request()->ip();
        $logData = [
            'model' => null,
            'model_id' => null,
            'user_id' => null,
            'old_data' => $request->all(),
            'new_data' => null,
            'action' => 'LogOut Auth',
            'location' => $ip,
            'reason' => 'Berhasil Logout ' . auth()->user()->nama,
            'how' => 'Logout',
            'timestamp' => now(),
        ];
        (new LogService)->handle($logData);

        Auth::logout();
        return redirect('/')->with('success', 'Logout Berhasil');
    }

    public function checkPasswordApproval(Request $request)
    {
        $password = $request->password;
        $user = Auth::user();

        if (Auth::attempt(['username' => $user->username, 'password' => $password])) {
            return response()->json(['success' => 'Password is correct'], 200);
        } else {
            return response()->json(['error' => 'Password is incorrect'], 401);
        }
    }
}
