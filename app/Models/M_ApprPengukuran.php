<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class M_ApprPengukuran extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_approval_pengukuran';

    protected $fillable = [
        'req_id',
        'punch_id',
        'dies_id',
        'user_id',
        'tgl_submit',
        'due_date',
        'approved_by',
        'approved_at',
        'is_approved',
        'is_rejected',
    ];

    public function autonumber()
    {
        $builder = DB::table($this->table);
        $builder->select('req_id');
        $builder->orderBy('req_id', 'desc');
        $builder->limit(1);
        return $query = $builder->get();
    }
}
