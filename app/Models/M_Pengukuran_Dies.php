<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class M_Pengukuran_Dies extends Model
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;

    protected $table = 'pengukuran_awal_diess';
    protected $guarded;
}
