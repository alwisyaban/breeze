<?php

namespace App\Exports;

use App\Models\karyawan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Karyawan::with(['kualifikasiTeori', 'kualifikasiGowning'])->get()->map(function ($karyawan) {
            $karyawan->whereIn('jenis_kualifikasi', ['rekualifikasi', 'aseptis']);
            return [
                'NIK' => $karyawan->nik,
                'Name' => $karyawan->name,
                'Departemen' => $karyawan->departemen,
                'Tanggal Kualifikasi teori' => $karyawan->KualifikasiTeori->tanggal_kualifikasi ?? 'NA',
                'Nilai Kualifikasi Teori' => $karyawan->KualifikasiTeori->nilai ?? 'NA',
                'Hasil Kualifikasi Teori' => $karyawan->KualifikasiTeori->hasil ?? 'NA',
                'Tanggal Rekualifikasi Teori' => $karyawan->KualifikasiTeori->tanggal_rekualifikasi ?? 'NA',
                'Type Kualifikasi' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'rekualifikasi')->first()->jenis_kualifikasi ?? 'NA',
                'Tanggal Kualifikasi' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'rekualifikasi')->first()->tanggal_kualifikasi ?? 'NA',
                'Hasil Kualifikasi' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'rekualifikasi')->first()->hasil ?? 'NA',
                'Tanggal Rekualifikasi' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'rekualifikasi')->first()->tanggal_rekualifikasi ?? 'NA',

                'Aseptis' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'aseptis')->first()->jenis_kualifikasi ?? 'NA',
                'Tanggal aseptis' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'aseptis')->first()->tanggal_kualifikasi ?? 'NA',
                'Hasil aseptis' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'aseptis')->first()->hasil ?? 'NA',
                'Tanggal Reasptis' => $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'aseptis')->first()->tanggal_rekualifikasi ?? 'NA',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Name',
            'Departemen',
            'Tanggal Kualifikasi teori',
            'Nilai Kualifikasi Teori',
            'Hasil Kualifikasi Teori',
            'Tanggal Rekualifikasi Teori',
            'Type Kualifikasi (rekualifikasi)',
            'Tanggal Kualifikasi',
            'Hasil Kualifikasi',
            'Tanggal Rekualifikasi',
            'Aseptis',
            'Tanggal Kualifikasi aseptis',
            'Hasil aseptis',
            'Tanggal Reaseptis',
        ];
    }
}
