<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    protected $table = 'inspeksis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nik',
        'tanggal_kualifikasi',
        'nomer',
        'kualifikasi',
        'bentuk_sediaan',
        'jenis_sediaan',
        'nilai',
        'salah',
        'false_reject',
        'keterangan',
        'hasil',
        'tanggal_rekualifikasi'
    ];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'nik', 'nik');
    }
}
