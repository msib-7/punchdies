<?php

namespace Database\Seeders;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = Route::getRoutes()->getRoutesByName();
        $roles = Roles::all();


        //Eng Permission
        foreach ($roles as $role) {
            foreach ($routes as $routeName => $route) {
                // Check if the route prefix is 'pnd'
                if (
                    str_starts_with($routeName, 'pnd.pa.') || 
                    str_starts_with($routeName, 'pnd.approval.histori.') ||

                    $routeName == 'pnd.pr.atas.list' ||
                    $routeName == 'pnd.pr.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pr.atas.view' ||
                    $routeName == 'pnd.pr.bawah.list' ||
                    $routeName == 'pnd.pr.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pr.bawah.view' ||
                    $routeName == 'pnd.pr.dies.list' ||
                    $routeName == 'pnd.pr.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pr.dies.view' ||

                    $routeName == 'login' || 
                    $routeName == 'logout' || 
                    $routeName == 'dashboard' || 
                    $routeName == 'audit'
                    ) {
                    // If the role is Engineering, allow permissions for 'pnd.pa.*', 'login', 'logout', and 'dashboard'
                    if ($role->role_name === 'Engineering') {
                        // Create permission for the role
                        Permissions::create([
                            'url' => $routeName,
                            'role_id' => $role->id
                        ]);
                    }
                }
            }
        }

        //Operator Permission
        foreach ($roles as $role) {
            foreach ($routes as $routeName => $route) {
                // Check if the route prefix is 'pnd'
                if (
                    str_starts_with($routeName, 'pnd.pr.') || 
                    str_starts_with($routeName, 'pnd.approval.histori.') ||

                    $routeName == 'pnd.pa.atas.list' ||
                    $routeName == 'pnd.pa.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pa.atas.view' ||
                    $routeName == 'pnd.pa.bawah.list' ||
                    $routeName == 'pnd.pa.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pa.bawah.view' ||
                    $routeName == 'pnd.pa.dies.list' ||
                    $routeName == 'pnd.pa.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pa.dies.view' ||

                    $routeName == 'login' || 
                    $routeName == 'logout' || 
                    $routeName == 'dashboard' || 
                    $routeName == 'audit'
                    ) {
                    // If the role is Engineering, allow permissions for 'pnd.pa.*', 'login', 'logout', and 'dashboard'
                    if ($role->role_name === 'Operator') {
                        // Create permission for the role
                        Permissions::create([
                            'url' => $routeName,
                            'role_id' => $role->id
                        ]);
                    }
                }
            }
        }

        //Supervisor Eng Permission
        foreach ($roles as $role) {
            foreach ($routes as $routeName => $route) {
                // Check if the route prefix is 'pnd'
                if (
                    str_starts_with($routeName, 'pnd.approval.pa.') || 
                    str_starts_with($routeName, 'pnd.approval.histori.') ||
                    $routeName == 'pnd.pa.atas.index' ||
                    $routeName == 'pnd.pa.atas.list' ||
                    $routeName == 'pnd.pa.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pa.atas.view' ||
                    $routeName == 'pnd.pa.bawah.index' ||
                    $routeName == 'pnd.pa.bawah.list' ||
                    $routeName == 'pnd.pa.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pa.bawah.view' ||
                    $routeName == 'pnd.pa.dies.index' ||
                    $routeName == 'pnd.pa.dies.list' ||
                    $routeName == 'pnd.pa.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pa.dies.view' ||

                    $routeName == 'pnd.pr.atas.index' ||
                    $routeName == 'pnd.pr.atas.list' ||
                    $routeName == 'pnd.pr.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pr.atas.view' ||
                    $routeName == 'pnd.pr.bawah.index' ||
                    $routeName == 'pnd.pr.bawah.list' ||
                    $routeName == 'pnd.pr.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pr.bawah.view' ||
                    $routeName == 'pnd.pr.dies.index' ||
                    $routeName == 'pnd.pr.dies.list' ||
                    $routeName == 'pnd.pr.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pr.dies.view' ||

                    $routeName == 'login' || 
                    $routeName == 'logout' || 
                    $routeName == 'dashboard' || 
                    $routeName == 'audit'
                ) {
                    // If the role is Engineering, allow permissions for 'pnd.pa.*', 'login', 'logout', and 'dashboard'
                    if ($role->role_name === 'Supervisor Engineering') {
                        // Create permission for the role
                        Permissions::create([
                            'url' => $routeName,
                            'role_id' => $role->id
                        ]);
                    }
                }
            }
        }

        //Supervisor Prod Permission
        foreach ($roles as $role) {
            foreach ($routes as $routeName => $route) {
                // Check if the route prefix is 'pnd'
                if (
                    str_starts_with($routeName, 'pnd.approval.pr.') || 
                    str_starts_with($routeName, 'pnd.approval.histori.') ||
                    str_starts_with($routeName, 'pnd.request.disposal.') ||
                    $routeName == 'pnd.pa.atas.index' ||
                    $routeName == 'pnd.pa.atas.list' ||
                    $routeName == 'pnd.pa.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pa.atas.view' ||
                    $routeName == 'pnd.pa.bawah.index' ||
                    $routeName == 'pnd.pa.bawah.list' ||
                    $routeName == 'pnd.pa.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pa.bawah.view' ||
                    $routeName == 'pnd.pa.dies.index' ||
                    $routeName == 'pnd.pa.dies.list' ||
                    $routeName == 'pnd.pa.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pa.dies.view' ||

                    $routeName == 'pnd.pr.atas.index' ||
                    $routeName == 'pnd.pr.atas.list' ||
                    $routeName == 'pnd.pr.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pr.atas.view' ||
                    $routeName == 'pnd.pr.bawah.index' ||
                    $routeName == 'pnd.pr.bawah.list' ||
                    $routeName == 'pnd.pr.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pr.bawah.view' ||
                    $routeName == 'pnd.pr.dies.index' ||
                    $routeName == 'pnd.pr.dies.list' ||
                    $routeName == 'pnd.pr.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pr.dies.view' ||

                    $routeName == 'login' || 
                    $routeName == 'logout' || 
                    $routeName == 'dashboard' || 
                    $routeName == 'audit'
                ) {
                    // If the role is Engineering, allow permissions for 'pnd.pa.*', 'login', 'logout', and 'dashboard'
                    if ($role->role_name === 'Supervisor Produksi') {
                        // Create permission for the role
                        Permissions::create([
                            'url' => $routeName,
                            'role_id' => $role->id
                        ]);
                    }
                }
            }
        }

        //Manager Prod Permission
        foreach ($roles as $role) {
            foreach ($routes as $routeName => $route) {
                // Check if the route prefix is 'pnd'
                if ( 
                    str_starts_with($routeName, 'pnd.approval.dis.') ||
                    str_starts_with($routeName, 'pnd.approval.histori.') ||
                    $routeName == 'pnd.pa.atas.index' ||
                    $routeName == 'pnd.pa.atas.list' ||
                    $routeName == 'pnd.pa.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pa.atas.view' ||
                    $routeName == 'pnd.pa.bawah.index' ||
                    $routeName == 'pnd.pa.bawah.list' ||
                    $routeName == 'pnd.pa.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pa.bawah.view' ||
                    $routeName == 'pnd.pa.dies.index' ||
                    $routeName == 'pnd.pa.dies.list' ||
                    $routeName == 'pnd.pa.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pa.dies.view' ||

                    $routeName == 'pnd.pr.atas.index' ||
                    $routeName == 'pnd.pr.atas.list' ||
                    $routeName == 'pnd.pr.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pr.atas.view' ||
                    $routeName == 'pnd.pr.bawah.index' ||
                    $routeName == 'pnd.pr.bawah.list' ||
                    $routeName == 'pnd.pr.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pr.bawah.view' ||
                    $routeName == 'pnd.pr.dies.index' ||
                    $routeName == 'pnd.pr.dies.list' ||
                    $routeName == 'pnd.pr.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pr.dies.view' ||

                    $routeName == 'login' || 
                    $routeName == 'logout' || 
                    $routeName == 'dashboard' || 
                    $routeName == 'audit'
                ) {
                    // If the role is Engineering, allow permissions for 'pnd.pa.*', 'login', 'logout', and 'dashboard'
                    if ($role->role_name === 'Manager Produksi') {
                        // Create permission for the role
                        Permissions::create([
                            'url' => $routeName,
                            'role_id' => $role->id
                        ]);
                    }
                }
            }
        }

        //Guest Permission
        foreach ($roles as $role) {
            foreach ($routes as $routeName => $route) {
                // Check if the route prefix is 'pnd'
                if (
                    $routeName == 'pnd.pa.atas.index' ||
                    $routeName == 'pnd.pa.atas.list' ||
                    $routeName == 'pnd.pa.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pa.atas.view' ||
                    $routeName == 'pnd.pa.bawah.index' ||
                    $routeName == 'pnd.pa.bawah.list' ||
                    $routeName == 'pnd.pa.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pa.bawah.view' ||
                    $routeName == 'pnd.pa.dies.index' ||
                    $routeName == 'pnd.pa.dies.list' ||
                    $routeName == 'pnd.pa.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pa.dies.view' ||

                    $routeName == 'pnd.pr.atas.index' ||
                    $routeName == 'pnd.pr.atas.list' ||
                    $routeName == 'pnd.pr.atas.cek-pengukuran' ||
                    $routeName == 'pnd.pr.atas.view' ||
                    $routeName == 'pnd.pr.bawah.index' ||
                    $routeName == 'pnd.pr.bawah.list' ||
                    $routeName == 'pnd.pr.bawah.cek-pengukuran' ||
                    $routeName == 'pnd.pr.bawah.view' ||
                    $routeName == 'pnd.pr.dies.index' ||
                    $routeName == 'pnd.pr.dies.list' ||
                    $routeName == 'pnd.pr.dies.cek-pengukuran' ||
                    $routeName == 'pnd.pr.dies.view' ||

                    $routeName == 'login' ||
                    $routeName == 'logout' ||
                    $routeName == 'dashboard' ||
                    $routeName == 'audit'
                ) {
                    // If the role is Engineering, allow permissions for 'pnd.pa.*', 'login', 'logout', and 'dashboard'
                    if ($role->role_name === 'Guest') {
                        // Create permission for the role
                        Permissions::create([
                            'url' => $routeName,
                            'role_id' => $role->id
                        ]);
                    }
                }
            }
        }
    }
}