<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    protected $table = 'inspeksis';
    protected $primaryKey = 'id_inspeksi';
    protected $fillable = [
        'nik',
        'tanggal_kualifikasi',
        'bentuk_sediaan',
        'jenis_sediaan',
        'nilai',
        'hasil',
        'tanggal_rekualifikasi'
    ];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'nik', 'nik');
    }
}
