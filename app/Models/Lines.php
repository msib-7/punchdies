<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lines extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_line';

    protected $fillable = [
        'nama_line',
    ];
}
