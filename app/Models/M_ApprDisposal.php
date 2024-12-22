<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class M_ApprDisposal extends Model
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;

    protected $table = 'approval_disposals';
    protected $guarded;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function punch()
    {
        return $this->belongsTo(Punch::class, 'punch_id', 'punch_id');
    }
    public function dies()
    {
        return $this->belongsTo(Dies::class, 'dies_id', 'dies_id');
    }

    public function autonumber()
    {
        $builder = DB::table($this->table);
        $builder->select('req_id');
        $builder->orderBy('req_id', 'desc');
        $builder->limit(1);
        return $query = $builder->get();
    }
}
