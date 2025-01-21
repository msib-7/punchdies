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

    public function kalibrasi1()
    {
        return $this->belongsTo(KalibrasiTool::class, 'kalibrasi_tools_1', 'id');
    }
    public function kalibrasi2()
    {
        return $this->belongsTo(KalibrasiTool::class, 'kalibrasi_tools_2', 'id');
    }
    public function kalibrasi3()
    {
        return $this->belongsTo(KalibrasiTool::class, 'kalibrasi_tools_3', 'id');
    }
}
