<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'role_id',
        'line_id',
        'last_login_at',
        'line_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getUserRole($where = false)
    {
        if($where === false){
            $builder = DB::table('users');
            $builder->select('*');
            $builder->Join('roles', 'users.role_id', '=', 'roles.id');
            $builder->orderBy('users.id', 'asc');
            return $query = $builder->get();
        } else {
            $builder = DB::table('users');
            $builder->select('*');
            $builder->where($where);
            $builder->Join('roles', 'users.role_id', '=', 'roles.id');
            $builder->orderBy('users.id', 'asc');
            return $query = $builder->get();
        }
    }
}
