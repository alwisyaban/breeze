<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $table = 'karyawans';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'nik',
        'name',
        'initial',
        'departemen',
    ];

    public function KualifikasiTeori()
    {
        return $this->hasOne(KualifikasiTeori::class, 'nik', 'nik');
    }
    public function inspeksi()
    {
        return $this->hasMany(Inspeksi::class, 'nik', 'nik');
    }

    public function kualifikasiGowning()
    {
        return $this->hasMany(KualifikasiGowning::class, 'nik', 'nik');
    }
}
