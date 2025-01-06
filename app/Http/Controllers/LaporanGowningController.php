<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanGowningController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter departemen dari request (array)
        $selectedDepartments = $request->input('departemen', []);
        $line = $request->input('line'); // Ambil nilai line dari request, default LINE 02
        // Query utama
        $data = karyawan::with(['kualifikasiTeori', 'kualifikasiGowning' => function ($query) {
            $query->whereIn('jenis_kualifikasi', ['rekualifikasi', 'aseptis']);
        }])
            ->whereHas('kualifikasiTeori', function ($query) {
                $query->where('hasil', 'QUALIFIED') // Filter hanya yang QUALIFIED pada kualifikasi teori
                    ->whereDate('tanggal_rekualifikasi', '>=', Carbon::today());
            })
            ->whereHas('kualifikasiGowning', function ($query) {
                $query->where('jenis_kualifikasi', 'rekualifikasi')
                    ->where('hasil', 'QUALIFIED') // Filter hanya yang QUALIFIED pada rekualifikasi
                    ->whereDate('tanggal_rekualifikasi', '>=', Carbon::today());
            })
            ->when($selectedDepartments, function ($query) use ($selectedDepartments) {
                $query->whereIn('departemen', $selectedDepartments); // Filter berdasarkan departemen
            })
            ->orderBy('departemen', 'asc')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($karyawan) {
                // Modifikasi data untuk jenis_kualifikasi 'aseptis'
                $karyawan->kualifikasiGowning->map(function ($kualifikasi) {
                    if (
                        $kualifikasi->jenis_kualifikasi === 'aseptis' &&
                        Carbon::parse($kualifikasi->tanggal_rekualifikasi)->lt(Carbon::today())
                    ) {
                        $kualifikasi->tanggal_rekualifikasi = 'NA';
                        $kualifikasi->hasil = 'NOT QUALIFIED';
                    } else {
                        // Format tanggal menjadi 29 Jan 2025
                        $kualifikasi->tanggal_rekualifikasi = Carbon::parse($kualifikasi->tanggal_rekualifikasi)->format('d M Y');
                    }
                    return $kualifikasi;
                });
                return $karyawan;
            });

        // Ambil daftar departemen untuk dropdown filter
        $departments = Karyawan::select('departemen')
            ->distinct()
            ->orderBy('departemen')
            ->pluck('departemen');



        // Kirim data ke view
        return view('laporan.gowning.index', compact('data', 'departments', 'selectedDepartments', 'line'));
    }

    public function generatePDF(Request $request)
    {
        $selectedDepartments = $request->input('departemen', []);
        $line = $request->input('line'); // Ambil nilai line dari request, default LINE 02
        $data = karyawan::with(['kualifikasiTeori', 'kualifikasiGowning' => function ($query) {
            $query->whereIn('jenis_kualifikasi', ['rekualifikasi', 'aseptis']);
        }])
            ->whereHas('kualifikasiTeori', function ($query) {
                $query->where('hasil', 'QUALIFIED')
                    ->orderBy('departemen')
                    ->whereDate('tanggal_rekualifikasi', '>=', Carbon::today());
            })
            ->whereHas('kualifikasiGowning', function ($query) {
                $query->where('jenis_kualifikasi', 'rekualifikasi')
                    ->where('hasil', 'QUALIFIED')
                    ->whereDate('tanggal_rekualifikasi', '>=', Carbon::today());
            })
            ->when($selectedDepartments, function ($query) use ($selectedDepartments) {
                $query->whereIn('departemen', $selectedDepartments);
            })
            ->orderBy('departemen', 'asc')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($karyawan) {
                // Modifikasi data untuk jenis_kualifikasi 'aseptis'
                $karyawan->kualifikasiGowning->map(function ($kualifikasi) {
                    if (
                        $kualifikasi->jenis_kualifikasi === 'aseptis' &&
                        Carbon::parse($kualifikasi->tanggal_rekualifikasi)->lt(Carbon::today())
                    ) {
                        $kualifikasi->tanggal_rekualifikasi = 'NA';
                        $kualifikasi->hasil = 'NOT QUALIFIED';
                    } else {
                        // Format tanggal menjadi 29 Jan 2025
                        $kualifikasi->tanggal_rekualifikasi = Carbon::parse($kualifikasi->tanggal_rekualifikasi)->format('d M Y');
                    }
                    return $kualifikasi;
                });
                return $karyawan;
            });



        // Generate PDF
        $pdf = Pdf::loadView('laporan.gowning.pdf', compact('data', 'line'));
        $pdf->output();
        $domPdf = $pdf->getDomPDF();

        $canvas = $domPdf->get_canvas();
        // $canvas->page_text(10, 10, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", null, 10, [0, 0, 0]); // atas kiri
        $canvas->page_text(35, $canvas->get_height() - 40, "SOP-QA-Q004.08L05", null, 10, [0, 0, 0]); // kiri bawah

        // Posisi teks pada kanan bawah
        $page_width = $canvas->get_width(); // Lebar halaman
        $text_width = 100; // Perkiraan panjang teks (sesuaikan jika teks lebih panjang)
        $x_position = $page_width - $text_width - -10; // 10 adalah padding dari tepi kanan
        $y_position = $canvas->get_height() - 40; // 20 adalah padding dari tepi bawah

        // Tambahkan teks nomor halaman
        $canvas->page_text($x_position, $y_position, "page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);

        // Set ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan_Gowning.pdf');
    }
}
