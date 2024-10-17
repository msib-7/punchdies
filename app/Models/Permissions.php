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
}
