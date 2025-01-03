<?php

namespace App\Http\Controllers;

use App\Models\DashboardGowning;
use App\Models\karyawan;
use App\Models\KualifikasiGowning;
use App\Models\KualifikasiTeori;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardGowningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hari = Carbon::now();
        $startDate = Carbon::now()->startOfMonth(); // Awal bulan ini
        $endDate = Carbon::now()->addMonths(2)->endOfMonth(); // Akhir dua bulan ke depan
        $startMonth = $startDate->format('M');
        $endMonth = $endDate->format('M');

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
            ->get();
        return view('dashboard.gowning.index', compact('teori', 'steril', 'aseptis', 'hari', 'data', 'startDate', 'endDate', 'startMonth', 'endMonth'));
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
            ->get();

        return view('dashboard.gowning.teori', compact('kualifikasiTeori'));
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
