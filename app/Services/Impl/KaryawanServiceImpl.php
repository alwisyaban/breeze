<?php

namespace App\Services\Impl;

use App\Models\karyawan;
use App\Services\KaryawanService;

class KaryawanServiceImpl implements KaryawanService
{
    public function saveKaryawan(array $data): void
    {
        karyawan::create([
            'nik' => $data['nik'],
            'name' => $data['name'],
            'initial' => $data['initial'],
            'departemen' => $data['departemen'],
        ]);
    }

    public function getKaryawan(): array
    {
        $karyawans = karyawan::orderBy('departemen')
            ->orderBy('name', 'asc')
            ->get()->toArray();

        return $karyawans;
    }

    public function updateKaryawan(string $id, array $data): void
    {
        $karyawans = karyawan::findOrFail($id);
        $karyawans->update($data);
    }

    public function removeKaryawan(string $id)
    {
        $karyawan = karyawan::query()->findOrFail($id);
        $karyawan->KualifikasiTeori()->delete();
        $karyawan->kualifikasiGowning()->delete();
        $karyawan->delete();
    }
}
