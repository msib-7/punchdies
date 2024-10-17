<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RolesPermission extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'role_permission';

    protected $fillable = [
        'permission_id',
        'role_id',
    ];
}
