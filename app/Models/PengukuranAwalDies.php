<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PengukuranAwalDies extends Model
{
    use HasFactory, Notifiable, AuditTrailable, UUIDAsPrimaryKey;

    protected $table = 'pengukuran_awal_diess';
    protected $guarded;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
