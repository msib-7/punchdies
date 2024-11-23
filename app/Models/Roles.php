<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Roles extends Model
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;

    protected $table = 'role';

    protected $guarded;

    public function getRoleJoinPermission($where = false)
    {
        if($where === false){
            $builder = DB::table($this->table);
            $builder->select('*');
            $builder->Join('role_permission', 'role.id','=', 'role_permission.role_id');
            $builder->Join('permission', 'role_permission.permission_id','=', 'permission.id');
            $builder->orderBy('role.id', 'asc');
            return $query = $builder->get();
        }else{
            $builder = DB::table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->Join('role_permission', 'role.id', '=', 'role_permission.role_id');
            $builder->Join('permission', 'role_permission.permission_id', '=', 'permission.id');
            $builder->orderBy('role.id', 'asc');
            return $query = $builder->get();
        }
    }
}
