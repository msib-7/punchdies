<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Models\Lines;
use App\Models\User;
use App\Services\LogService;
use Carbon\Carbon;
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

        if (Auth::attempt($infoLogin)) {

            if (stripos($users->roles->role_name, 'Administrator') !== false) {
                // Abaikan next update password untuk Administrator
                $users->update(['failed_attempts' => 0, 'is_blocked' => false, 'next_update_password' => '0000-00-00 00:00:00']);

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

                return response()->json(['success' => true, 'message' => 'Login berhasil'], 200);
            }

            // Periksa apakah akun diblokir
            if ($users->is_blocked) {
                return response()->json(['error' => 'Akun Anda diblokir. Silakan hubungi administrator.'], 403);
            }

            $nextUpdatePassword = Carbon::parse(Auth::user()->next_update_password);
            $daysUntilNextUpdate = $nextUpdatePassword->diffInDays(now());

            // Convert to absolute value and round up to the nearest whole number
            $daysUntilNextUpdate = ceil(abs($daysUntilNextUpdate));

            if (now()->greaterThan($nextUpdatePassword)) {
                // Blokir akun jika sudah melewati tanggal pembaruan
                Auth::user()->update(['is_blocked' => true]);
                return response()->json(['error' => 'Akun Anda telah diblokir karena tidak memperbarui password. Silahkan hubungi admin!'], 403);
            } elseif ($daysUntilNextUpdate < 7) {
                // Buat NOtifikasi Ke Pengirim
                event(new NotificationEvent(
                    auth()->user()->id,
                    'Password Reminder!',
                    'Password Anda akan kedaluwarsa dalam kurang dari 7 hari. Silakan perbarui segera. Kadaluarsa Setelah: ' . $daysUntilNextUpdate . ' hari.',
                    null,
                ));

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

                // Kirim pengingat jika kurang dari 7 hari
                return response()->json([
                    'reminder' => true,
                    'success' => true,
                    'message' => 'Password Anda akan kedaluwarsa dalam kurang dari 7 hari. Silakan perbarui segera. lihat detail pada notifikasi'
                ], 200);

            }


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
        $user = auth()->user(); // Get the authenticated user

        if ($user === null) {
            // No user is authenticated
            $logData = [
                'model' => null,
                'model_id' => null,
                'user_id' => null,
                'old_data' => $request->all(),
                'new_data' => null,
                'action' => 'Logout',
                'location' => $ip,
                'reason' => 'User  Logging out by System.',
                'how' => 'Logout',
                'timestamp' => now(),
            ];
        } else {
            // User is authenticated
            $logData = [
                'model' => null,
                'model_id' => null,
                'user_id' => $user->id, // Assuming you want to log the user ID
                'old_data' => $request->all(),
                'new_data' => null,
                'action' => 'Logout',
                'location' => $ip,
                'reason' => 'Berhasil Logout ' . $user->nama,
                'how' => 'Logout',
                'timestamp' => now(),
            ];
        }

        (new LogService)->handle($logData);

        $this->destroy();
        return redirect('/login')->with('success', 'Logout Berhasil');

    }
    
    private function destroy()
    {
        Auth::logout();
    }

    public function checkPasswordApproval(Request $request)
    {
        $password = $request->password;
        $action = $request->action;

        $user = Auth::user();

        if (Auth::attempt(['username' => $user->username, 'password' => $password])) {
            if (in_array($action, ['approve', 'reject', 'revisi'])) {
                return response()->json(['success' => 'Password is correct', 'pass' => 'true', 'action' => $action], 200);
            }
        } else {
            return response()->json(['error' => 'Password is incorrect'], 401);
        }
    }
}
