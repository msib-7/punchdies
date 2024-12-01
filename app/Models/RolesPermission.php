<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RolesPermission extends Model
{
    use HasFactory, Notifiable;

    protected $guarded;

    public function deleteRoleData($where)
    {
        $builder = DB::table($this->table);
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy('role.id', 'asc');
        return $query = $builder->delete();
    }
}
