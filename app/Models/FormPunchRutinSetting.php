<?php

namespace App\Models;

use App\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FormPunchRutinSetting extends Model
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey;

    protected $guarded;
}
