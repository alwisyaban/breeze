<?php

namespace App\Services\Impl;

use App\Models\Inspeksi;
use App\Services\InspeksiService;

class InspeksiServiceImpl implements InspeksiService
{
    public function saveInspeksi(array $data): void
    {
        Inspeksi::create([
            'nik' => $data['nik'],
            'tanggal_kualifikasi' => $data['tanggal_kualifikasi'],
            'bentuk_sediaan' => $data['bentuk_sediaan'],
            'jenis_sediaan' => $data['jenis_sediaan'],
            'nilai' => $data['nilai'],
            'hasil' => $data['hasil'],
            'tanggal_rekualifikasi' => $data['tanggal_rekualifikasi'],
        ]);
    }

    public function getInspeksi(): array
    {
        $inspeksi = Inspeksi::with('karyawan')
            ->join('karyawans', 'inspeksis.nik', '=', 'karyawans.nik')
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('inspeksis.*') // Pilih kolom
            ->get()->toArray();

        return $inspeksi;
    }

    public function removeInspeksi($id)
    {
        $inspeksi = Inspeksi::findOrFail($id);
        $inspeksi->delete();
    }

    public function updateInspeksi(string $id, array $data)
    {
        $inspeksi = Inspeksi::findOrFail($id);
        $inspeksi->update($data);
    }
}
