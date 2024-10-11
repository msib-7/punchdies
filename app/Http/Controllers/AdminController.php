<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view("admin.dashboard");
    }
    public function manajemen_user()
    {
        return view("admin/manajemen-user/data-user");
    }

    public function add_user(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        
    }
}
