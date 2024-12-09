<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PengukuranAwalPunch extends Model
{
    use HasFactory, Notifiable, AuditTrailable, UUIDAsPrimaryKey;

    protected $table = "pengukuran_awal_punchs";
    protected $guarded;
}
