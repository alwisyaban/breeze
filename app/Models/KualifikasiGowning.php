<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KualifikasiGowning extends Model
{
    protected $table = 'kualifikasi_gownings';
    protected $primaryKey = 'id_kualifikasiGowning';
    protected $fillable = [
        'nik',
        'jenis_kualifikasi',
        'tanggal_kualifikasi',
        'dahi',
        'muka_ka',
        'muka_ki',
        'dada_ka',
        'dada_ki',
        'lengan_ka',
        'lengan_ki',
        'finger_ka',
        'finger_ki',
        'hasil',
        'tanggal_rekualifikasi'
    ];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'nik', 'nik');
    }
}
