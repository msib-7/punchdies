<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class M_Pengukuran_Punch extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_pengukuran_punch';

    protected $fillable = [
        'punch_id',
        'user_id',
        'head_outer_diameter',
        'neck_diameter',
        'barrel',
        'overall_length',
        'tip_diameter_1',
        'tip_diameter_2',
        'cup_depth',
        'working_length',
        'head_configuration',
        'masa_pengukuran',
        'note',
        'is_draft',
        'is_delete_pp',
        'is_edit'
    ];
}
