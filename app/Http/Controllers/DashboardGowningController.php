<?php

namespace App\Http\Controllers;

use App\Exports\DashboardTeoriExport;
use App\Models\DashboardGowning;
use App\Models\karyawan;
use App\Models\KualifikasiGowning;
use App\Models\KualifikasiTeori;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardGowningController extends Controller
{
    public function index()
    {
        $hari = Carbon::now();
        $startDate = Carbon::now()->startOfMonth(); // Awal bulan ini
        $endDate = Carbon::now()->addMonths(2)->endOfMonth(); // Akhir dua bulan ke depan
        $startMonth = $startDate->format('M');
        $endMonth = $endDate->format('M');

        // Menghitung jumlah kualifikasi berdasarkan filter waktu
        $teori = KualifikasiTeori::where('hasil', 'QUALIFIED')
            ->whereBetween('tanggal_rekualifikasi', [$startDate, $endDate])
            ->count();

        $steril = KualifikasiGowning::where('jenis_kualifikasi', 'rekualifikasi')
            ->where('hasil', 'QUALIFIED')
            ->whereBetween('tanggal_rekualifikasi', [$startDate, $endDate])
            ->count();

        $aseptis = KualifikasiGowning::where('jenis_kualifikasi', 'aseptis')
            ->where('hasil', 'QUALIFIED')
            ->whereBetween('tanggal_rekualifikasi', [$startDate, $endDate])
            ->count();

        // Mendapatkan data karyawan dengan relasi dan logika tambahan
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

        // data no dokumen pendukung BN IKTRB50839
        // $tgl_cb = Carbon::parse('2025-04-10 16:16:00');
        // $tgl_terima = Carbon::parse('2025-04-10 18:20:00');
        // $tgl_sfc = Carbon::parse('2025-04-10 18:20:00');
        // $tgl_efc = Carbon::parse('2025-04-10 19:10:00');
        // $tgl_ssc = Carbon::parse('2025-04-10 19:10:00');
        // $tgl_esc = Carbon::parse('2025-04-10 20:00:00');
        // $tgl_slws = Carbon::parse('2025-04-11 08:49:00');
        // $tgl_elws = Carbon::parse('2025-04-11 08:53:00');
        // $tgl_release = Carbon::parse('2025-04-11 08:54:00');
        // $tgl_dok_pendukung = null;
        // $pengembalian = null;
        // $off_time = 0;

        // data dengan dokumen pendukung VPALA50119
        $tgl_cb = Carbon::parse('2025-03-13 22:49:00');
        $tgl_terima = Carbon::parse('2025-03-14 22:00:00');
        $tgl_sfc = Carbon::parse('2025-03-14 22:00:00');
        $tgl_efc = Carbon::parse('2025-03-14 22:50:00');
        $tgl_ssc = Carbon::parse('2025-03-15 07:00:00');
        $tgl_esc = Carbon::parse('2025-03-15 07:53:00');
        $tgl_slws = Carbon::parse('2025-03-19 16:50:00');
        $tgl_elws = Carbon::parse('2025-03-19 16:58:00');
        $tgl_release = Carbon::parse('2025-04-8 18:03:00');

        $tgl_dok_pendukung = '2025-04-8 18:00:00';
        $pengembalian = null;
        $off_time = 480;

        $A1 = $tgl_terima->diffInMinutes($tgl_sfc);
        $A2 = $tgl_sfc->diffInMinutes($tgl_efc);
        $A = $A1 + $A2;

        $B1 = $tgl_efc->diffInMinutes($tgl_ssc); // dikurangi off_time nanti
        $B2 = $tgl_ssc->diffInMinutes($tgl_esc);
        $B = ($B1 - $off_time) + $B2;

        $C1 = $tgl_slws->diffInMinutes($tgl_slws); // hasil 0
        $C2 = $tgl_slws->diffInMinutes($tgl_elws);
        $C = $C1 + $C2;

        $D1 = 0;
        $D2 = 0;

        if ($tgl_terima > $tgl_slws && $tgl_dok_pendukung == null || $tgl_terima > $tgl_dok_pendukung || $pengembalian = null) {
            if ($tgl_elws > $tgl_esc) {
                $D1 = $tgl_elws->diffInMinutes($tgl_release);
            } else {
                $D1 = $tgl_esc->diffInMinutes($tgl_release);
            }
        } elseif ($tgl_dok_pendukung > 0 || $tgl_dok_pendukung > $tgl_terima || $tgl_dok_pendukung > $tgl_slws && $pengembalian = null || $tgl_dok_pendukung > $pengembalian || $pengembalian = null || $tgl_dok_pendukung > $pengembalian) {
            $D2 = Carbon::parse($tgl_dok_pendukung)->diffInMinutes($tgl_release);
        }


        $D = $D1 + $D2;

        $J = $A + $B + $C + $D;
        $jam = floor($J / 60);
        $menit = $J % 60;

        $minus = $A . "|" . $B . "|" . $C . "|" . $D . "|" . $jam . " Jam " . $menit . " menit";

        return view('dashboard.gowning.index', compact(
            'teori',
            'steril',
            'aseptis',
            'hari',
            'data',
            'startDate',
            'endDate',
            'startMonth',
            'endMonth',
            'minus'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function teori()
    {
        $startDate = Carbon::now()->startOfMonth(); // Awal bulan ini
        $endDate = Carbon::now()->addMonths(2)->endOfMonth(); // Akhir dua bulan ke depan

        $kualifikasiTeori = KualifikasiTeori::where('hasil', 'QUALIFIED')
            ->whereBetween('tanggal_rekualifikasi', [$startDate, $endDate])
            ->join('karyawans', 'kualifikasi_teoris.nik', '=', 'karyawans.nik') // Gabungkan tabel karyawan
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('kualifikasi_teoris.*') // Pilih kolom dari kualifikasi_gownings
            ->get();

        return view('dashboard.gowning.teori', compact('kualifikasiTeori'));
    }

    public function export()
    {
        $startDate = Carbon::now()->startOfMonth(); // Awal bulan ini
        $endDate = Carbon::now()->addMonths(2)->endOfMonth();

        return Excel::download(
            new DashboardTeoriExport($startDate, $endDate),
            'rekualifikasi-teori.xlsx'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function steril()
    {

        $startDate = Carbon::now()->startOfMonth(); // Awal bulan ini
        $endDate = Carbon::now()->addMonths(2)->endOfMonth(); // Akhir dua bulan ke depan
        $kualifikasiGowning = KualifikasiGowning::where('jenis_kualifikasi', 'rekualifikasi')
            ->where('hasil', 'QUALIFIED')
            ->whereBetween('tanggal_rekualifikasi', [$startDate, $endDate])
            ->join('karyawans', 'kualifikasi_gownings.nik', '=', 'karyawans.nik') // Gabungkan tabel karyawan
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('kualifikasi_gownings.*') // Pilih kolom dari kualifikasi_gownings
            ->get();

        return view('dashboard.gowning.steril', compact('kualifikasiGowning'));
    }
    public function aseptis()
    {
        $startDate = Carbon::now()->startOfMonth(); // Awal bulan ini
        $endDate = Carbon::now()->addMonths(2)->endOfMonth(); // Akhir dua bulan ke depan
        $kualifikasiGowning = KualifikasiGowning::where('jenis_kualifikasi', 'aseptis')
            ->where('hasil', 'QUALIFIED')
            ->whereBetween('tanggal_rekualifikasi', [$startDate, $endDate])
            ->join('karyawans', 'kualifikasi_gownings.nik', '=', 'karyawans.nik') // Gabungkan tabel karyawan
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('kualifikasi_gownings.*') // Pilih kolom dari kualifikasi_gownings
            ->get();

        return view('dashboard.gowning.aseptis', compact('kualifikasiGowning'));
    }



    public function filter(Request $request)
    {

        // Ambil filter departemen dari request (array)
        $selectedDepartments = $request->input('departemen', []);

        // Query utama
        $data = karyawan::with(['kualifikasiTeori', 'kualifikasiGowning' => function ($query) {
            $query->whereIn('jenis_kualifikasi', ['rekualifikasi', 'aseptis']);
        }])
            ->whereHas('kualifikasiTeori', function ($query) {
                $query->where('hasil', 'QUALIFIED'); // Filter hanya yang QUALIFIED pada kualifikasi teori
            })
            ->whereHas('kualifikasiGowning', function ($query) {
                $query->where('jenis_kualifikasi', 'rekualifikasi')
                    ->where('hasil', 'QUALIFIED'); // Filter hanya yang QUALIFIED pada rekualifikasi
            })
            ->when($selectedDepartments, function ($query) use ($selectedDepartments) {
                $query->whereIn('departemen', $selectedDepartments); // Filter berdasarkan departemen
            })
            ->get();

        // Ambil daftar departemen untuk dropdown filter
        $departments = Karyawan::select('departemen')
            ->distinct()
            ->orderBy('departemen')
            ->pluck('departemen');

        // Kirim data ke view
        return view('dashboard.gowning.index', compact('data', 'departments', 'selectedDepartments'));
    }
}
