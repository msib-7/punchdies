<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use App\Models\RolesPermission;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Log;
use Route;
use Str;

class Role extends Controller
{
    //Start Role
    public function manajemen_role()
    {
        $modelRole = new Roles();

        $dataRoles = Roles::orderBy('role_name', 'asc')->get();

        $permissions = Permissions::all(); 

        $routes = Route::getRoutes()->getRoutesByName();

        return view("admin/manajemen-role/data-role", compact('dataRoles', 'permissions', 'routes'));
    }
    public function add_role(Request $request)
    {
        $request->validate([
            'urls' => 'required|array',
            'role_name' => 'required|string',
        ]);
        
        DB::beginTransaction();

        $role = Roles::create([
            'role_name' => $request->input('role_name'),
        ]);

        foreach ($request->input('urls', []) as $url) {
            $role->permission()->create(['url' => $url]);
        }

        DB::commit();

        return redirect()->route('admin.role.index')->with('success', 'Role & Permissions created successfully.');
    }
    public function view_role($id)
    {
        $modelRole = new Roles();
        $roles = Roles::where('id', $id)->first();

        // Retrieve all users with the specified role ID
        $users = User::where('role_id', $id)->get(); // Change this line

        $permissions = Permissions::where('role_id', $id)->get();

        $routes = Route::getRoutes()->getRoutesByName();

        return view("admin/manajemen-role/view-role", compact('roles', 'users', 'permissions' , 'routes'));
    }
    public function edit_role(Request $request, $id)
    {
        // $data = Roles::where('id', '=', $id)->first();
        $request->session()->put('id', $id);

        $role = Roles::with('permission')->find($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data' => $role
        ]);
    }
    public function update_role(Request $request, $id)
    {

        $role = Roles::findOrFail($id);

        // Delete old permissions if any
        $role->permission()->delete();

        // Update permissions based on selected URLs
        foreach ($request->input('eurls', []) as $url) {
            $role->permission()->create(['url' => $url]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success Update',
            'redirect' => route('admin.role.index') // Ensure this route exists
        ]);

    }
    public function del_role($id)
    {
        $role = Roles::findOrFail($id);

        // Delete old permissions if any
        $role->permission()->delete();

        Roles::where('id', '=', $id)->delete();

        return redirect(route('admin.role.index'))->with('success', 'Role has been deleted!');
    }
}
