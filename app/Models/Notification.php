<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;
}
