<?php

namespace App\Models;

use App\Traits\AuditTrailable;
use App\UUIDAsPrimaryKey;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dies extends Model
{
    use HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;

    protected $table = 'diess';
    protected $guarded;

    public function autoId()
    {
        $builder = DB::table($this->table);
        $builder->select('dies_id');
        $builder->orderBy('dies_id', 'desc');
        $builder->limit(1);
        return $query = $builder->get();
    }
}
