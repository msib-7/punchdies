<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permissions extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'permission';

    protected $fillable = [
        'id',
        'name',
    ];

    // public function getDataPermissionJoin($where = false)
    // {
    //     if ($where === false) {
    //         $builder = DB::table('permission');
    //         $builder->select('*');
    //         $builder->leftJoin('role_permission', 'permission.id', '=', 'role_permission.permission_id');
    //         $builder->leftJoin('role', 'role.id', '=', 'role_permission.role_id');
    //         $builder->orderBy('permission.id', 'ASC');
    //         return $query = $builder->get();
    //     } else {
    //         $builder = DB::table('permission');
    //         $builder->select('*');
    //         $builder->where($where);
    //         $builder->leftJoin('role_permission', 'permission.id', '=', 'role_permission.permission_id');
    //         $builder->leftJoin('role', 'role_permission.role_id', '=', 'role.id');
    //         $builder->orderBy('permission.id', 'ASC');
    //         return $query = $builder->get();
    //     }
    // }
}
