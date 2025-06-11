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
            'nomer' => $data['nomer'],
            'kualifikasi' => $data['kualifikasi'],
            'bentuk_sediaan' => $data['bentuk_sediaan'],
            'jenis_sediaan' => $data['jenis_sediaan'],
            'nilai' => $data['nilai'],
            'salah' => $data['salah'],
            'false_reject' => $data['false_reject'],
            'keterangan' => $data['keterangan'],
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
            ->orderBy('inspeksis.jenis_sediaan') // Lalu urutkan berdasarkan jenis sediaan
            ->orderBy('inspeksis.nomer') // Lalu urutkan berdasarkan nomer
            ->orderBy('inspeksis.kualifikasi') // Lalu urutkan berdasarkan kualifikasi

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
