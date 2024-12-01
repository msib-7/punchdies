<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PengukuranAwalPunch extends Model
{
    use HasFactory, Notifiable;

    protected $table = "pengukuran_awal_punchs";
    // protected $fillable = [
    //     'punch_id', 'user_id', 'head_outer_diameter', 'neck_diameter', 'barrel', 'overall_length', 'tip_diameter_1', 'tip_diameter_2', 'cup_depth', 'working_length', 'head_configuration', 'masa_pengukuran','note', 'is_draft'
    // ];
    protected $guarded;
}
