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

    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }
    public function permissions()
    {
        return $this->hasMany(Permissions::class, 'role_id', 'role_id');
    }
    public function lines()
    {
        return $this->belongsTo(Lines::class, 'line_id', 'id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function notify()
    {
        return $this->notifications()->orderBy('created_at', 'desc')->get();
    }
}
