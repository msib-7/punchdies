<?php

namespace App\Http\Controllers;

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
    public function mount()
    {
        // Get all permissions.
        $this->permissions = Permissions::all();
        // Set the checked permissions property to an empty array.
        $this->checked_permissions = [];
    }
    public function dashboard()
    {
        return view("admin.dashboard");
    }

    
}