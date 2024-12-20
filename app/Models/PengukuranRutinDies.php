<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PengukuranRutinDies extends Model
{
    use HasFactory, Notifiable, AuditTrailable, UUIDAsPrimaryKey;

    protected $table = "pengukuran_rutin_diess";
    protected $guarded;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
