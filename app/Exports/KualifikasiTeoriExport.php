<?php

namespace App\Exports;

use App\Models\karyawan;
use App\Models\kualifikasiTeori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KualifikasiTeoriExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Karyawan::with(['kualifikasiTeori'])
            ->whereHas('kualifikasiTeori', function ($query) {
                $query->whereBetween('tanggal_kualifikasi', [$this->startDate, $this->endDate]);
            })
            ->orderBy('departemen')
            ->get()
            ->map(function ($karyawan) {
                return [
                    'NIK' => $karyawan->nik,
                    'Name' => $karyawan->name,
                    'Departemen' => $karyawan->departemen,
                    'Tanggal Kualifikasi' => $karyawan->kualifikasiTeori->tanggal_kualifikasi ?? 'NA',
                    'Nilai' => $karyawan->kualifikasiTeori->nilai ?? 'NA',
                    'Hasil' => $karyawan->kualifikasiTeori->hasil ?? 'NA',
                    'Tanggal Rekualifikasi' => $karyawan->kualifikasiTeori->tanggal_rekualifikasi ?? 'NA',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'Departemen',
            'Tanggal Kualifikasi',
            'Nilai',
            'Hasil',
            'Tanggal Rekualifikasi'

        ];
    }
}
