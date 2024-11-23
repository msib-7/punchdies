<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class M_Pengukuran_Dies extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_pengukuran_dies';

    protected $fillable = [
        'dies_id',
        'user_id',
        'outer_diameter',
        'inner_diameter_1',
        'inner_diameter_2',
        'ketinggian_dies',
        'visual',
        'kesesuaian_dies',
        'masa_pengukuran',
        'note',
        'is_draft',
        'is_delete_pd',
        'is_edit',
        'is_approved',
        'is_rejected'
    ];
}
