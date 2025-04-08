<?php

namespace App\Services\Impl;

use App\Models\KualifikasiGowning;
use App\Services\KualifikasiGowningService;

class KualifikasiGowningServiceImpl implements KualifikasiGowningService
{
    public function saveKualifikasiGwoning(array $data): void
    {
        KualifikasiGowning::create([
            'nik' => $data['nik'],
            'jenis_kualifikasi' => $data['jenis_kualifikasi'],
            'tanggal_kualifikasi' => $data['tanggal_kualifikasi'],
            'dahi' => $data['dahi'],
            'muka_ka' => $data['muka_ka'],
            'muka_ki' => $data['muka_ki'],
            'dada_ka' => $data['dada_ka'],
            'dada_ki' => $data['dada_ki'],
            'lengan_ka' => $data['lengan_ka'],
            'lengan_ki' => $data['lengan_ki'],
            'finger_ka' => $data['finger_ka'],
            'finger_ki' => $data['finger_ki'],
            'hasil' => $data['hasil'],
            'tanggal_rekualifikasi' => $data['tanggal_rekualifikasi'],
        ]);
    }

    public function getKualifikasiGowning(): array
    {
        $kualifikasiGowning = KualifikasiGowning::with('karyawan')
            ->join('karyawans', 'kualifikasi_gownings.nik', '=', 'karyawans.nik') // Gabungkan tabel karyawan
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('kualifikasi_gownings.*') // Pilih kolom dari kualifikasi_gownings
            ->get()->toArray();

        return $kualifikasiGowning;
    }

    public function updateKualifikasiGowning(string $id, $data): void
    {
        $kualifikasiGowning = KualifikasiGowning::findOrFail($id);
        $kualifikasiGowning->update($data);
    }

    public function removeKualifikasiGowning(string $id)
    {
        $kualifikasiGowning = KualifikasiGowning::findOrFail($id);
        $kualifikasiGowning->delete();
    }
}
