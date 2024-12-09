<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Audit_tr extends Model
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey;

    protected $table = 'audit_trails';

    protected $fillable = ['model', 'model_id', 'action', 'old_data', 'new_data', 'user_id'];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}