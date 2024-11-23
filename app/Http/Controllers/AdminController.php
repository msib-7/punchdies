<?php

namespace App\Http\Controllers;

use App\Models\M_Dies;
use App\Models\M_Punch;
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
    public function dashboard()
    {
        //Get All Data Punch Atas
        $dataPunchAtas = M_Punch::where(['jenis' => 'punch-atas', 'is_delete_punch' => '0'])->get();
        $data['dataPunchAtas'] = $dataPunchAtas;

        //Get All Data Puch Bawah
        $dataPunchBawah = M_Punch::where(['jenis' => 'punch-bawah', 'is_delete_punch' => '0'])->get();
        $data['dataPunchBawah'] = $dataPunchBawah;

        //Total Punch
        $totalPunch = M_Punch::where('is_delete_punch', '0')->count();
        $data['totalPunch'] = $totalPunch;
        
        //Get All Data Dies
        $dataDies = M_Dies::where(['jenis' => 'dies', 'is_delete_dies' => '0'])->get();
        $data['dataDies'] = $dataDies;
        
        //Total Dies
        $totalDies = M_Dies::where('is_delete_dies', '0')->count();
        $data['totalDies'] = $totalDies;

        $data['uri'] = 'dashboard';

        return view("admin.dashboard", $data);
    }

    
}