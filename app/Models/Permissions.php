<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permissions extends Model
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;


    protected $guarded;
}
