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
            $rekualifikasi = $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'rekualifikasi')->first();
            $aseptis = $karyawan->kualifikasiGowning->where('jenis_kualifikasi', 'aseptis')->first();

            return [
                'NIK' => $karyawan->nik,
                'Name' => $karyawan->name,
                'Departemen' => $karyawan->departemen,
                'Tanggal Kualifikasi teori' => $karyawan->kualifikasiTeori && $karyawan->kualifikasiTeori->tanggal_kualifikasi
                    ? Carbon::parse($karyawan->kualifikasiTeori->tanggal_kualifikasi)->translatedFormat('d M Y')
                    : 'NA',
                'Nilai Kualifikasi Teori' => $karyawan->kualifikasiTeori->nilai ?? 'NA',
                'Hasil Kualifikasi Teori' => $karyawan->kualifikasiTeori->hasil ?? 'NA',
                'Tanggal Rekualifikasi Teori' => $karyawan->kualifikasiTeori && $karyawan->kualifikasiTeori->tanggal_rekualifikasi
                    ? Carbon::parse($karyawan->kualifikasiTeori->tanggal_rekualifikasi)->translatedFormat('d M Y')
                    : 'NA',
                'Type Kualifikasi' => $rekualifikasi->jenis_kualifikasi ?? 'NA',
                'Tanggal Kualifikasi' => $rekualifikasi && $rekualifikasi->tanggal_kualifikasi
                    ? Carbon::parse($rekualifikasi->tanggal_kualifikasi)->translatedFormat('d M Y')
                    : 'NA',
                'Hasil Kualifikasi' => $rekualifikasi->hasil ?? 'NA',
                'Tanggal Rekualifikasi' => $rekualifikasi && $rekualifikasi->tanggal_rekualifikasi
                    ? Carbon::parse($rekualifikasi->tanggal_rekualifikasi)->translatedFormat('d M Y')
                    : 'NA',
                'Aseptis' => $aseptis->jenis_kualifikasi ?? 'NA',
                'Tanggal aseptis' => $aseptis && $aseptis->tanggal_kualifikasi
                    ? Carbon::parse($aseptis->tanggal_kualifikasi)->translatedFormat('d M Y')
                    : 'NA',
                'Hasil aseptis' => $aseptis->hasil ?? 'NA',
                'Tanggal Reasptis' => $aseptis && $aseptis->tanggal_rekualifikasi
                    ? Carbon::parse($aseptis->tanggal_rekualifikasi)->translatedFormat('d M Y')
                    : 'NA',
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
