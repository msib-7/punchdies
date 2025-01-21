<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use App\Models\User;
use App\Services\LogService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

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

    if (empty($users)) {
        // Log untuk username tidak ditemukan
        $logData = [
            'model' => null,
            'model_id' => null,
            'user_id' => null,
            'action' => 'Login Auth',
            'location' => $ip,
            'reason' => 'User Tidak Terdaftar ' . $username,
            'how' => 'Login',
            'timestamp' => now(),
            'old_data' => $infoLogin,
            'new_data' => null,
        ];
        (new LogService)->handle($logData);

        return response()->json(['error' => 'User tidak terdaftar'], 401);
    }

    // Periksa apakah akun diblokir
    if ($users->is_blocked) {
        return response()->json(['error' => 'Akun Anda diblokir. Silakan hubungi administrator.'], 403);
    }

    if (Auth::attempt($infoLogin)) {
        // Reset failed_attempts setelah login berhasil
        $users->update(['failed_attempts' => 0]);

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
        // Login gagal: Password salah
        $users->increment('failed_attempts');

        // Jika gagal 3 kali, blokir akun
        if ($users->failed_attempts >= 3) {
            $users->update(['is_blocked' => true]);

            $logData = [
                'model' => null,
                'model_id' => null,
                'user_id' => $users->id,
                'action' => 'Account Blocked',
                'location' => $ip,
                'reason' => 'Akun diblokir setelah 3 kali gagal login',
                'how' => 'Login',
                'timestamp' => now(),
                'old_data' => $infoLogin,
                'new_data' => null,
            ];
            (new LogService)->handle($logData);

            return response()->json(['error' => 'Akun Anda telah diblokir karena terlalu banyak percobaan login yang gagal.'], 403);
        }

        // Log untuk password salah
        $logData = [
            'model' => null,
            'model_id' => null,
            'user_id' => $users->id,
            'action' => 'Login Auth',
            'location' => $ip,
            'reason' => 'Password Salah untuk User ' . $username,
            'how' => 'Login',
            'timestamp' => now(),
            'old_data' => $infoLogin,
            'new_data' => null,
        ];
        (new LogService)->handle($logData);

        return response()->json(['error' => 'Username dan Password tidak cocok!'], 401);
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
        $action = $request->action;

        $user = Auth::user();

        if (Auth::attempt(['username' => $user->username, 'password' => $password])) {
            if ($action === 'approve') {
                return response()->json(['success' => 'Password is correct','pass' => 'true'], 200);
            }elseif($action == 'reject'){
                return response()->json(['success' => 'Password is correct','pass' => 'true'], 200);
            }
        } else {
            return response()->json(['error' => 'Password is incorrect'], 401);
        }
    }

    public function updatePassword(Request $request) {
        $id = $request->id;
        $new_password = $request->new_password;

        try {
            DB::beginTransaction();

            $users = User::find($id);

            User::where('id', $id)->update(['password' => bcrypt($new_password), 'failed_attempts' => 0]);

            $logData = [
                'model' => null,
                'model_id' => null,
                'user_id' => auth()->user()->id,
                'action' => 'Change Password',
                'location' => request()->ip(),
                'reason' => 'User ' . $users->nama . ' telah mengganti password',
                'how' => 'Change Password',
                'timestamp' => now(),
                'old_data' => null,
                'new_data' => null,
            ];
            (new LogService)->handle($logData);

            DB::commit();

            return response()->json([
                'message' => 'Password Updated Successfully!',
                'by' => auth()->user()->nama
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error Updating Passwords: ' . $th->getMessage());

            $logData = [
                'model' => null,
                'model_id' => null,
                'user_id' => auth()->user()->id,
                'action' => 'Change Password',
                'location' => request()->ip(),
                'reason' => 'Error Updating Password by, ' . auth()->user()->nama,
                'how' => 'Change Password',
                'timestamp' => now(),
                'old_data' => null,
                'new_data' => null,
            ];
            (new LogService)->handle($logData);

            return response()->json([
                'success' => false,
                'message' => 'Error Updating Passwords by,',
                'by' => auth()->user()->nama
            ]);
        }
    }
}
