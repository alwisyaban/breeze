<?php

namespace App\Services\Impl;

use App\Models\KualifikasiTeori;
use App\Services\KualifikasiTeoriService;

class KualifikasiTeoriServiceImpl implements KualifikasiTeoriService
{
    public function saveKualifikasiTeori(array $data): void
    {
        KualifikasiTeori::create([
            'nik' => $data['nik'],
            'tanggal_kualifikasi' => $data['tanggal_kualifikasi'],
            'nilai' => $data['nilai'],
            'hasil' => $data['hasil'],
            'tanggal_rekualifikasi' => $data['tanggal_rekualifikasi'],
        ]);
    }

    public function getKualifikasiTeori(): array
    {
        $kualifikasiTeori = KualifikasiTeori::with('karyawan')
            ->join('karyawans', 'kualifikasi_teoris.nik', '=', 'karyawans.nik')
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('kualifikasi_teoris.*') // Pilih kolom dari kualifikasi_gownings
            ->get()->toArray();

        return $kualifikasiTeori;
    }

    public function updateKualifikasiTeori(string $id, array $data)
    {
        $kualifikasiTeori = KualifikasiTeori::findOrFail($id);
        $kualifikasiTeori->update($data);
    }

    public function removeKualifikasiTeori($id)
    {
        $kualifikasiTeori = KualifikasiTeori::findOrFail($id);
        $kualifikasiTeori->delete();
    }
}
