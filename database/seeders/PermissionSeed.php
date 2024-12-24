<?php

namespace Database\Seeders;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Route;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = Route::getRoutes()->getRoutesByName();
        $role = Roles::latest()->get();

        $adminRole = Roles::firstOrCreate(['name' => 'Administrator']);
        foreach($role as $item){
            foreach($routes as $routeName => $route){
                if(str_starts_with($route->getPrefix(), 'pnd')){
                    Permissions::create([
                        'url' => $routeName,
                        'role_id' => $item->id
                    ]);
                }
            }
        }
    }
}
