<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Punch extends Model
{
    use HasFactory, Notifiable, AuditTrailable, UUIDAsPrimaryKey;
    
    protected $table = 'punchs';

    protected $guarded;

    public function autoId()
    {
        $builder = DB::table($this->table);
        $builder->select('punch_id');
        $builder->orderBy('punch_id', 'desc');
        $builder->limit(1);
        return $query = $builder->get();
    }
}
