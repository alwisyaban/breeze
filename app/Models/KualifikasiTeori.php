<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KualifikasiTeori extends Model
{
    protected $table = 'kualifikasi_teoris';
    protected $primaryKey = 'id_kualifikasiTeori';
    protected $fillable = [
        'nik',
        'tanggal_kualifikasi',
        'nilai',
        'hasil',
        'tanggal_rekualifikasi'
    ];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'nik', 'nik');
    }
}
