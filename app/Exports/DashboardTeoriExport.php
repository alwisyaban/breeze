<?php

namespace App\Exports;

use App\Models\karyawan;
use App\Models\kualifikasiTeori;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DashboardTeoriExport implements FromCollection, WithHeadings
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
        return karyawan::with(['kualifikasiTeori'])
            ->whereHas('kualifikasiTeori', function ($query) {
                $query->whereBetween('tanggal_rekualifikasi', [$this->startDate, $this->endDate]);
            })
            ->orderBy('departemen')
            ->get()
            ->map(function ($karyawan) {
                return [
                    'NIK' => $karyawan->nik,
                    'Name' => $karyawan->name,
                    'Departemen' => $karyawan->departemen,
                    'Tanggal Kualifikasi' => Carbon::parse($karyawan->kualifikasiTeori->tanggal_kualifikasi)->format('d M Y') ?? 'NA',
                    'Nilai' => $karyawan->kualifikasiTeori->nilai ?? 'NA',
                    'Hasil' => $karyawan->kualifikasiTeori->hasil ?? 'NA',
                    'Tanggal Rekualifikasi' => Carbon::parse($karyawan->kualifikasiTeori->tanggal_rekualifikasi)->format('d M Y')  ?? 'NA'
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
