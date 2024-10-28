<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Audit_tr extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'audit_tr';

    protected $fillable = [
        'id',
        'event',
        'logdate',
        'user_id',
        'line',
        'category',
        'detail',
    ];
}