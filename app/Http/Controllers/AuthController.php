<?php

namespace App\Http\Controllers;

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

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Username field is required!',
            'password.required' => 'Password field is required',
        ]);

        $infoLogin = [
            'username' => $username,
            'password' => $password
        ];
        

        if (Auth::attempt($infoLogin)) {
            return redirect("/dashboard-admin
            ")->with('success','Login Berhasil!');
        } else {
            return redirect('/')->with( 'error','Username dan Password tidak cocok!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Berhasil');
    }
}
