<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class M_ApprDisposal extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_approval_disposal';

    protected $fillable = [
        'req_id',
        'punch_id',
        'user_id',
        'tgl_submit',
        'due_date',
        'approved_by',
        'approved_at',
        'approved_note',
        'attach_1',
        'attach_2',
        'attach_3',
        'attach_4',
        'attach_5',
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
