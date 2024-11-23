<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class M_Dies extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_dies';

    protected $fillable = [
        'merk',
        'bulan_pembuatan',
        'tahun_pembuatan',
        'nama_mesin_cetak',
        'nama_produk',
        'kode_produk',
        'line_id',
        'jenis',
        'masa_pengukuran',
        'is_draft',
        'is_delete_dies',
        'is_edit',
        'is_approved',
        'is_rejected',
    ];
}
